<?php

use Carbon\Carbon;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\JobRequest;

use App\Notifications\ApplyToJob;

use App\Notifications\AcceptedToJob;

use App\Job;

use App\AcceptedJob;

use App\User;


use Session;

use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
	public function __construct(){
		//$this->middleware('auth');
		$this->middleware('auth',['except' => [
			'index',
		]]);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$job_list = Job::orderBy('id','asc')->paginate(5);
		$jobCount = Job::count();
		return view('job/index',compact('job_list','jobCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('job.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        //
		$data = $request->all();
		$data['id_user'] = Auth::user()->id;
		Job::create($data);
		Session::flash('flash_message','Data kelas berhasil disimpan.');
		return redirect('job/manage');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
		return view ('job.show',compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage(){
		$job_list = Auth::user()->job()->paginate(5);
		$jobCount = Auth::user()->job()->count();
		return view ('job.manage',compact ('job_list','jobCount'));
	}
	public function edit(Job $job)
    {
        //
		$applicantCount = $job->applicant()->count();
		return view('job.edit',compact('job','applicantCount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Job $job,Request $request)
    {
		$job->update($request->all());
		
		$job_list = Job::orderBy('id','asc')->paginate(5);
		$jobCount = Job::count();
		return view('job/index',compact('job_list','jobCount'));
    }
	public function cari(Request $request){
		$word = $request->get('word');
		if ($word != '' ){
			$query = Job::where('jobTitle',
								'LIKE',
								'%'.$word. '%');
			
			$job_list = $query->paginate(5);
			$jobCount = $job_list->total();		
			$pagination = $job_list->appends(['word' => $word]);
			
			return view('job.index',compact('job_list','word','pagination','jobCount'));
		}
		return redirect('job');
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
		$job->delete();
		Session::flash('flash_message','Data kelas berhasil didelete.');
		Session::flash('penting',true);
		$job_list = Auth::user();
		$jobCount = Job::all()->count();
		return redirect ('job/manage');
    }
	
	public function apply($id,Request $request){
		if ( Auth::user()->occupation == 'Client'){
			return 'You Are a Client';
		}
		$input = $request->all();
		$job = Job::find($id);
		$user = Auth::user();
		
		$job->user->notify(new ApplyToJob($id,Auth::user()->id));
		
		$user->applying()->attach($job->id);
		
		$job_list = Job::orderBy('id','asc')->paginate(5);
		$jobCount = Job::count();
		return view('job/index',compact('job_list','jobCount'));
	}
	public function accept($id_user,$id_job){
		$job = Job::find($id_job);
		$isExist = $job->applicant()->where('id',$id_user)->exists();
		if ($isExist != 1){
			echo "not Valid! <br>";
		}else{
			$acceptedJob = json_decode($job, true);
			$tempArray = array('id' => $job->id);
			$data = $acceptedJob + $tempArray;
			AcceptedJob::create($data);
			$user = User::find($id_user);
			$user->working()->attach($job->id);
			$job->delete();
		}
		User::find($id_user)->notify(new AcceptedToJob);
		return redirect ('job/manage');
	}
}
