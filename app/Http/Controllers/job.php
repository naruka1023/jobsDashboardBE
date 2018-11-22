<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\job;
use App\company;
use App\application;
use Illuminate\Http\Request;

class jobRetriever extends Controller
{
    //
    public function index(Request $request){
        $x = [];
        $jobDatabase = DB::table('jobs');
        if($request->fn == 'generalSearch'){
            if($request->location != null){
                $jobs = $jobDatabase->where('location', 'like', '%' . $request->location . '%');
            }
            if($request->title != null){
                $jobs = $jobDatabase->where('title', 'like', '%' . $request->title . '%');
            }
            if($request->company != null){
                $jobs = $jobDatabase->where('company', 'like', '%' . $request->company . '%');
            }
            // if($request->)
            return $jobs->select('jID', 'title', 'location', 'company', 'company_url')->get();
        }
    }

    public function show($id){
        return Job::find($id);
    }

    public function store(Request $request)
    {
        $job = Job::create($request->all());

        return response()->json($job, 201);
    }
    
    public function update(Request $request, $id){
        $job = Job::findOrFail($id);
        $job->update($request->all());

        return response()->json($job, 201);
    }

    public function delete(Request $request, $id){
        $job = Job::findOrFail($id);
        $job->delete();

        return response()->json($job, 201);
    }
    public function dashboardUpdate(Request $request){
        if(count($request->jTS) != 0){
            foreach($request->jTS as $job){
                $jobToUpdate = Job::findOrFail($job['jID']);
                $jobToUpdate->available = $job['available'];
                $jobToUpdate->company = $job['company'];
                $jobToUpdate->company_url = $job['company_url'];
                $jobToUpdate->location = $job['location'];
                $jobToUpdate->title = $job['title'];
                $jobToUpdate->type = $job['type'];
                $jobToUpdate->save();
            }
        }
        if(count($request->aTS) != 0){
            foreach($request->aTS as $application){
                $applicationToUpdate = Application::findOrFail($application['apID']);
                $applicationToUpdate->status = $application['status'];
                $applicationToUpdate->save();
            }
        }
        $responsePayload = array('success' => true);
        return $responsePayload;
    }
    public function dashboardIndex(Request $request){
        $sql  = ' select  jobs.cID, jobs.available, jobs.title,  jobs.location, jobs.type as type,jobs.company,';
        $sql .= ' jobs.company_url, jobs.url, jobs.company_logo, jobs.description, applications.jID, GROUP_CONCAT(applicants.name SEPARATOR ", ")';
        $sql .= ' as names, GROUP_CONCAT(applications.status SEPARATOR ", ") as status, GROUP_CONCAT(applications.apID SEPARATOR ", ") as apID,';
        $sql .= ' GROUP_CONCAT(applicants.aID SEPARATOR ", ") as nameIDs FROM applications';
        $sql .= ' inner join jobs on jobs.jID = applications.jID inner join applicants on applications.aID';
        $sql .= ' = applicants.aID where jobs.cID = ? group by title';
        $jobs = DB::select($sql, [$request->companyID]);
        
        
        $responsePayload= new \stdClass;
        $applicants= new \stdClass;
        $jobsFormatted= new \stdClass;

        $applicants->byId= [];
        $applicants->allIds = [];        
        $jobsFormatted->byId= [];
        $jobsFormatted->allIds = [];        

        foreach($jobs as $j){
            $j->apID = explode(', ', $j->apID);
            $j->nameIDs = explode(', ', $j->nameIDs);
            $j->names = explode(', ', $j->names);
            $j->status = explode(', ', $j->status);
            $jobsFormatted->byId[$j->jID] = new \stdClass;
            
            for($i = 0; $i < count($j->apID); $i++){
                $applicants->byId[$j->apID[$i]] = new \stdClass;

                $applicants->byId[$j->apID[$i]]->nameID = $j->nameIDs[$i];
                $applicants->byId[$j->apID[$i]]->name = $j->names[$i];
                $applicants->byId[$j->apID[$i]]->status = $j->status[$i];
                
                array_push($applicants->allIds, $j->apID[$i]);
            }
            
            array_push($jobsFormatted->allIds, $j->jID);
            unset($j->status);
            unset($j->nameIDs);
            unset($j->names);
            $jobsFormatted->byId[$j->jID] = $j;
        }
        $applicants->allIds = array_unique($applicants->allIds);
        $jobsFormatted->allIds = array_unique($jobsFormatted->allIds);

        $responsePayload->jobs = $jobsFormatted;
        $responsePayload->applicants = $applicants;
        $residual = DB::table('jobs')->where('cID', '=', $request->companyID)->get();
        
        foreach($residual as $r){
            if(!in_array($r->jID, $responsePayload->jobs->allIds)){
                $r->apID = [];
                unset($r->how_to_apply);
                unset($r->created_at);
                unset($r->updated_at);
                $responsePayload->jobs->byId[$r->jID] = $r;
                array_push($responsePayload->jobs->allIds, $r->jID);
            }
        }
        // return response()->json($responsePayload, 201);
        return response()->json($responsePayload, 201);
    }

    public function insertApplication(Request $request){

        $app = new Application;
        $app->apID = rand(40000, 49999);
        $app->aID  = $request->aID;
        $app->jID  = $request->jID;
        $app->save();

        $responsePayload = array('message'=> 'insert Successful!');

        return $responsePayload;
    }
    public function addJob(Request $request){
        $job = new Job();
        $job->available = $request->available;
        $job->cID = $request->cID;
        $job->company = $request->company;
        $job->company_logo = $request->company_logo;
        $job->company_url = $request->company_url;
        $job->jID = $request->jID;
        $job->location = $request->location;
        $job->title = $request->title;
        $job->type = $request->type;
        $job->save();
        return $request;
    }
    public function assignCompanyID(Request $request){
        $companyFromDB = DB::table('jobs')->distinct()->select('company')->get();
        $companyDefault = Company::select('companyName as company')->where('companyName', 'Bunny Inc.')->get();
        $a = [];
        foreach ($companyFromDB as $c){
            $companyID = Company::where('companyName', $c->company)->get();

            $jobsInCompany = Job::where('company', $c->company)->update(['cID' => $companyID->first()->cID]);
            
            // $company = new Company;
            // $company->cID = rand(60000, 69999);
            // $company->companyName = $c->company;
            // $company->save();
        }

        return response()->json($companyDefault);

    }
}
