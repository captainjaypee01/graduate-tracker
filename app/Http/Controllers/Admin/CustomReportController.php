<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ReportCharts;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomReportController extends Controller
{
    public function index(){
        $companies = Company::all();
        $students = Student::all();
        $schools = School::all();
        $job_positions = Student::distinct('job_position')->pluck('job_position');
        $company1 = Student::where('company_id', 1)->where('degree','Master\'s Degree')->count();
        $company2 = Student::where('company_id', 4)->where('degree','Master\'s Degree')->count();
        $chart = new ReportCharts; 
        $labels = array();
        $datasets = array();
        $datasets_degree = array();
        $datasets_employment_status = array();
        $datasets_age = array();
        $datasets_gender = array();
        $datasets_job_role = array();
        $datasets_job_position = array();
        $datasets_work_industry = array();
        $datasets_work_sector = array();
        $datasets_work_place = array();
        $datasets_school = array();
        $datasets_year_graduated = array();
        $datasets_company = array(); 
        $dataSetCount = $this->checkYData();
        // $this->checkYData();
        if($x_company = request()->get('x_company')){
            $companyName = Company::find($x_company)->name;
            $companyData = Student::where('company_id', $x_company);//->count();
            $labelData = 'Company ';
            if(request()->get('y_degree') != ""){
                $whereData = $this->convertDegree(request()->get('y_degree'));
                $totalData = Student::where('company_id', $x_company)->where('degree', $whereData)->count(); 
                array_push($datasets_degree, $totalData); 
            }
            
            if(request()->get("y_employment_status") != "") {
                $whereData = request()->get('y_employment_status'); 
                $totalData = Student::where('company_id', $x_company)->where('employment_status', $whereData)->count();  
                array_push($datasets_employment_status, $totalData); 
            }
            
            if(request()->get("y_job_role") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::where('company_id', $x_company)->where('job_role', $whereData)->count();  
                array_push($datasets_job_role, $totalData); 
            }
            
            if(request()->get("y_job_position") != "") {
                $whereData = request()->get('y_job_position'); 
                $totalData = Student::where('company_id', $x_company)->where('job_position', $whereData)->count(); 
                array_push($datasets_job_position, $totalData); 
            }
            
            if(request()->get("y_work_place") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::where('company_id', $x_company)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_place, $totalData); 
            }

            if(request()->get("y_work_industry") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::where('company_id', $x_company)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_industry, $totalData); 
            }

            if(request()->get("y_work_sector") != "") {
                $whereData = request()->get('y_work_sector'); 
                $totalData = Student::where('company_id', $x_company)->where('work_sector', $whereData)->count(); 
                array_push($datasets_work_sector, $totalData); 
            }

            if(request()->get("y_school") != "") {
                $whereData = request()->get('y_school'); 
                $totalData = Student::where('company_id', $x_company)->where('school_id', $whereData)->count(); 
                array_push($datasets_school, $totalData); 
            }

            if(request()->get("y_year_graduated") != "") {
                $whereData = request()->get('y_year_graduated'); 
                $totalData = Student::where('company_id', $x_company)->where('year_graduated', $whereData)->count(); 
                array_push($datasets_year_graduated, $totalData); 
            }

            if ($y_age = request()->get('y_age') && request()->get('y_age') != "") {
                $ageData = 0; 
                $studentAgeList = Student::where('company_id', $x_company)->get(); 
                foreach ($studentAgeList as $student ) {
                    if ($y_age == 'teen' && ($student->age >= 13 && $student->age <= 19 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'youth' && ($student->age >= 20 && $student->age <= 25 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'adult' && ($student->age >= 26 ) ) {            
                        $ageData++;
                    }
                }
                array_push($datasets_age, $ageData);  
            }

            $companyData = $companyData->count();
            array_push($labels, $labelData); 
            array_push($datasets, $companyData); 
        }
        if ($x_age = request()->get('x_age') && request()->get('x_age') != "") {
            $ageData = 0; 
            $ageIds = array();
            foreach ($students as $student ) {
                if ($x_age == 'teen' && ($student->age >= 13 && $student->age <= 19 ) ) {            
                    $ageData++;
                    array_push($ageIds, $student->id);
                }
                if ($x_age == 'youth' && ($student->age >= 20 && $student->age <= 25 ) ) {            
                    $ageData++;
                    array_push($ageIds, $student->id);
                }
                if ($x_age == 'adult' && ($student->age >= 26 ) ) {            
                    $ageData++;
                    array_push($ageIds, $student->id);
                }
            }

            
            if(request()->get('y_company') != ""){
                $whereData = request()->get('y_company');
                $totalData = Student::whereIn('id', $ageIds)->where('company_id', $whereData)->count(); 
                array_push($datasets_company, $totalData); 
            }
            
            if(request()->get('y_degree') != ""){
                $whereData = $this->convertDegree(request()->get('y_degree'));
                $totalData = Student::whereIn('id', $ageIds)->where('degree', $whereData)->count(); 
                array_push($datasets_degree, $totalData); 
            }

            if(request()->get("y_employment_status") != "") {
                $whereData = request()->get('y_employment_status'); 
                $totalData = Student::whereIn('id', $ageIds)->where('employment_status', $whereData)->count();  
                array_push($datasets_employment_status, $totalData); 
            }
            
            if(request()->get("y_job_role") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::whereIn('id', $ageIds)->where('job_role', $whereData)->count();  
                array_push($datasets_job_role, $totalData); 
            }
            
            if(request()->get("y_job_position") != "") {
                $whereData = request()->get('y_job_position'); 
                $totalData = Student::whereIn('id', $ageIds)->where('job_position', $whereData)->count(); 
                array_push($datasets_job_position, $totalData); 
            }
            
            if(request()->get("y_work_place") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::whereIn('id', $ageIds)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_place, $totalData); 
            }

            if(request()->get("y_work_industry") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::whereIn('id', $ageIds)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_industry, $totalData); 
            }

            if(request()->get("y_work_sector") != "") {
                $whereData = request()->get('y_work_sector'); 
                $totalData = Student::whereIn('id', $ageIds)->where('work_sector', $whereData)->count(); 
                array_push($datasets_work_sector, $totalData); 
            }

            if(request()->get("y_school") != "") {
                $whereData = request()->get('y_school'); 
                $totalData = Student::whereIn('id', $ageIds)->where('school_id', $whereData)->count(); 
                array_push($datasets_school, $totalData); 
            }

            if(request()->get("y_year_graduated") != "") {
                $whereData = request()->get('y_year_graduated'); 
                $totalData = Student::whereIn('id', $ageIds)->where('year_graduated', $whereData)->count(); 
                array_push($datasets_year_graduated, $totalData); 
            }

            array_push($labels, 'Age - ' . request()->get('x_age'));
            array_push($datasets, $ageData);
            
        }
        if ($x_degree = request()->get('x_degree') && request()->get('x_degree') != "") {
            $x_degree = $this->convertDegree($x_degree);
            $degreeData = Student::where('degree', $x_degree)->count();
            
            if(request()->get('y_company') != ""){
                $whereData = request()->get('y_company');
                $totalData = Student::where('degree', $x_degree)->where('company_id', $whereData)->count(); 
                array_push($datasets_company, $totalData); 
            }
            
            if(request()->get("y_employment_status") != "") {
                $whereData = request()->get('y_employment_status'); 
                $totalData = Student::where('degree', $x_degree)->where('employment_status', $whereData)->count();  
                array_push($datasets_employment_status, $totalData); 
            }
            
            if(request()->get("y_job_role") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::where('degree', $x_degree)->where('job_role', $whereData)->count();  
                array_push($datasets_job_role, $totalData); 
            }
            
            if(request()->get("y_job_position") != "") {
                $whereData = request()->get('y_job_position'); 
                $totalData = Student::where('degree', $x_degree)->where('job_position', $whereData)->count(); 
                array_push($datasets_job_position, $totalData); 
            }
            
            if(request()->get("y_work_place") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::where('degree', $x_degree)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_place, $totalData); 
            }

            if(request()->get("y_work_industry") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::where('degree', $x_degree)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_industry, $totalData); 
            }

            if(request()->get("y_work_sector") != "") {
                $whereData = request()->get('y_work_sector'); 
                $totalData = Student::where('degree', $x_degree)->where('work_sector', $whereData)->count(); 
                array_push($datasets_work_sector, $totalData); 
            }

            if(request()->get("y_school") != "") {
                $whereData = request()->get('y_school'); 
                $totalData = Student::where('degree', $x_degree)->where('school_id', $whereData)->count(); 
                array_push($datasets_school, $totalData); 
            }

            if(request()->get("y_year_graduated") != "") {
                $whereData = request()->get('y_year_graduated'); 
                $totalData = Student::where('degree', $x_degree)->where('year_graduated', $whereData)->count(); 
                array_push($datasets_year_graduated, $totalData); 
            }

            if ($y_age = request()->get('y_age') && request()->get('y_age') != "") {
                $ageData = 0; 
                $studentAgeList = Student::where('degree', $x_degree)->get(); 
                foreach ($studentAgeList as $student ) {
                    if ($y_age == 'teen' && ($student->age >= 13 && $student->age <= 19 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'youth' && ($student->age >= 20 && $student->age <= 25 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'adult' && ($student->age >= 26 ) ) {            
                        $ageData++;
                    }
                }
                array_push($datasets_age, $ageData);  
            } 
            array_push($labels, 'Degree - ' . $x_degree); 
            array_push($datasets, $degreeData);
        }

        if(request()->get("x_employment_status") != "") {
            $x_employment_status = request()->get('x_employment_status'); 
            $employmentStatusData = Student::where('employment_status', $x_employment_status)->count();
            
            if(request()->get('y_degree') != ""){
                $whereData = $this->convertDegree(request()->get('y_degree'));
                $totalData = Student::where('employment_status', $x_employment_status)->where('degree', $whereData)->count(); 
                array_push($datasets_degree, $totalData); 
            }
            
            if(request()->get("y_company") != "") {
                $whereData = request()->get('y_company'); 
                $totalData = Student::where('employment_status', $x_employment_status)->where('company_id', $whereData)->count();  
                array_push($datasets_company, $totalData); 
            }
            
            if(request()->get("y_job_role") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::where('employment_status', $x_employment_status)->where('job_role', $whereData)->count();  
                array_push($datasets_job_role, $totalData); 
            }
            
            if(request()->get("y_job_position") != "") {
                $whereData = request()->get('y_job_position'); 
                $totalData = Student::where('employment_status', $x_employment_status)->where('job_position', $whereData)->count(); 
                array_push($datasets_job_position, $totalData); 
            }
            
            if(request()->get("y_work_place") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::where('employment_status', $x_employment_status)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_place, $totalData); 
            }

            if(request()->get("y_work_industry") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::where('employment_status', $x_employment_status)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_industry, $totalData); 
            }

            if(request()->get("y_work_sector") != "") {
                $whereData = request()->get('y_work_sector'); 
                $totalData = Student::where('employment_status', $x_employment_status)->where('work_sector', $whereData)->count(); 
                array_push($datasets_work_sector, $totalData); 
            }

            if(request()->get("y_school") != "") {
                $whereData = request()->get('y_school'); 
                $totalData = Student::where('employment_status', $x_employment_status)->where('school_id', $whereData)->count(); 
                array_push($datasets_school, $totalData); 
            }

            if(request()->get("y_year_graduated") != "") {
                $whereData = request()->get('y_year_graduated'); 
                $totalData = Student::where('employment_status', $x_employment_status)->where('year_graduated', $whereData)->count(); 
                array_push($datasets_year_graduated, $totalData); 
            }

            if ($y_age = request()->get('y_age') && request()->get('y_age') != "") {
                $ageData = 0; 
                $studentAgeList = Student::where('employment_status', $x_employment_status)->get(); 
                foreach ($studentAgeList as $student ) {
                    if ($y_age == 'teen' && ($student->age >= 13 && $student->age <= 19 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'youth' && ($student->age >= 20 && $student->age <= 25 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'adult' && ($student->age >= 26 ) ) {            
                        $ageData++;
                    }
                }
                array_push($datasets_age, $ageData);  
            }
            array_push($labels, 'Employment Status - ' . $x_employment_status);
            array_push($datasets, $employmentStatusData);
        }

        if(request()->get("x_job_role") != "") {
            $x_job_role = request()->get('x_job_role'); 
            $jobRoleData = Student::where('job_role', $x_job_role)->count();
            
            if(request()->get('y_degree') != ""){
                $whereData = $this->convertDegree(request()->get('y_degree'));
                $totalData = Student::where('job_role', $x_job_role)->where('degree', $whereData)->count(); 
                array_push($datasets_degree, $totalData); 
            }
            
            if(request()->get("y_company") != "") {
                $whereData = request()->get('y_company'); 
                $totalData = Student::where('job_role', $x_job_role)->where('company_id', $whereData)->count();  
                array_push($datasets_company, $totalData); 
            }
            
            if(request()->get("y_employment_status") != "") {
                $whereData = request()->get('y_employment_status'); 
                $totalData = Student::where('job_role', $x_job_role)->where('employment_status', $whereData)->count();  
                array_push($datasets_employment_status, $totalData); 
            }
            
            if(request()->get("y_job_position") != "") {
                $whereData = request()->get('y_job_position'); 
                $totalData = Student::where('job_role', $x_job_role)->where('job_position', $whereData)->count(); 
                array_push($datasets_job_position, $totalData); 
            }
            
            if(request()->get("y_work_place") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::where('job_role', $x_job_role)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_place, $totalData); 
            }

            if(request()->get("y_work_industry") != "") {
                $whereData = request()->get('y_work_industry'); 
                $totalData = Student::where('job_role', $x_job_role)->where('work_industry', $whereData)->count(); 
                array_push($datasets_work_industry, $totalData); 
            }

            if(request()->get("y_work_sector") != "") {
                $whereData = request()->get('y_work_sector'); 
                $totalData = Student::where('job_role', $x_job_role)->where('work_sector', $whereData)->count(); 
                array_push($datasets_work_sector, $totalData); 
            }

            if(request()->get("y_school") != "") {
                $whereData = request()->get('y_school'); 
                $totalData = Student::where('job_role', $x_job_role)->where('school_id', $whereData)->count(); 
                array_push($datasets_school, $totalData); 
            }

            if(request()->get("y_year_graduated") != "") {
                $whereData = request()->get('y_year_graduated'); 
                $totalData = Student::where('job_role', $x_job_role)->where('year_graduated', $whereData)->count(); 
                array_push($datasets_year_graduated, $totalData); 
            }

            if ($y_age = request()->get('y_age') && request()->get('y_age') != "") {
                $ageData = 0; 
                $studentAgeList = Student::where('job_role', $x_job_role)->get(); 
                foreach ($studentAgeList as $student ) {
                    if ($y_age == 'teen' && ($student->age >= 13 && $student->age <= 19 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'youth' && ($student->age >= 20 && $student->age <= 25 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'adult' && ($student->age >= 26 ) ) {            
                        $ageData++;
                    }
                }
                array_push($datasets_age, $ageData);  
            }

            array_push($labels, 'Job Role - ' . $x_job_role);
            array_push($datasets, $jobRoleData);
        }

        if(request()->get("x_job_position") != "") {
            $x_job_position = request()->get('x_job_position'); 
            $jobPositionData = Student::where('job_position', $x_job_position)->count();
            
            if(request()->get('y_degree') != ""){
                $whereData = $this->convertDegree(request()->get('y_degree'));
                $totalData = Student::where('job_position', $x_job_position)->where('degree', $whereData)->count(); 
                array_push($datasets_degree, $totalData); 
            }
            
            if(request()->get("y_company") != "") {
                $whereData = request()->get('y_company'); 
                $totalData = Student::where('job_position', $x_job_position)->where('company_id', $whereData)->count();  
                array_push($datasets_company, $totalData); 
            }
            
            if(request()->get("y_employment_status") != "") {
                $whereData = request()->get('y_employment_status'); 
                $totalData = Student::where('job_position', $x_job_position)->where('employment_status', $whereData)->count();  
                array_push($datasets_employment_status, $totalData); 
            }
            
            if(request()->get("y_job_role") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::where('job_position', $x_job_position)->where('job_role', $whereData)->count(); 
                array_push($datasets_job_role, $totalData); 
            }
            
            if(request()->get("y_work_place") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::where('job_position', $x_job_position)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_place, $totalData); 
            }

            if(request()->get("y_work_industry") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::where('job_position', $x_job_position)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_industry, $totalData); 
            }

            if(request()->get("y_work_sector") != "") {
                $whereData = request()->get('y_work_sector'); 
                $totalData = Student::where('job_position', $x_job_position)->where('work_sector', $whereData)->count(); 
                array_push($datasets_work_sector, $totalData); 
            }

            if(request()->get("y_school") != "") {
                $whereData = request()->get('y_school'); 
                $totalData = Student::where('job_position', $x_job_position)->where('school_id', $whereData)->count(); 
                array_push($datasets_school, $totalData); 
            }

            if(request()->get("y_year_graduated") != "") {
                $whereData = request()->get('y_year_graduated'); 
                $totalData = Student::where('job_position', $x_job_position)->where('year_graduated', $whereData)->count(); 
                array_push($datasets_year_graduated, $totalData); 
            }

            if ($y_age = request()->get('y_age') && request()->get('y_age') != "") {
                $ageData = 0; 
                $studentAgeList = Student::where('job_position', $x_job_position)->get(); 
                foreach ($studentAgeList as $student ) {
                    if ($y_age == 'teen' && ($student->age >= 13 && $student->age <= 19 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'youth' && ($student->age >= 20 && $student->age <= 25 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'adult' && ($student->age >= 26 ) ) {            
                        $ageData++;
                    }
                }
                array_push($datasets_age, $ageData);  
            }

            array_push($labels, 'Job Position - ' . $x_job_position);
            array_push($datasets, $jobPositionData);
        }

        if(request()->get("x_work_place") != "") {
            $x_work_place = request()->get('x_work_place'); 
            $workPlaceData = Student::where('work_place', $x_work_place)->count();
            
            if(request()->get('y_degree') != ""){
                $whereData = $this->convertDegree(request()->get('y_degree'));
                $totalData = Student::where('work_place', $x_work_place)->where('degree', $whereData)->count(); 
                array_push($datasets_degree, $totalData); 
            }
            
            if(request()->get("y_company") != "") {
                $whereData = request()->get('y_company'); 
                $totalData = Student::where('work_place', $x_work_place)->where('company_id', $whereData)->count();  
                array_push($datasets_company, $totalData); 
            }
            
            if(request()->get("y_employment_status") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::where('work_place', $x_work_place)->where('employment_status', $whereData)->count();  
                array_push($datasets_employment_status, $totalData); 
            }
            
            if(request()->get("y_job_role") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::where('work_place', $x_work_place)->where('job_role', $whereData)->count(); 
                array_push($datasets_job_role, $totalData); 
            }
            
            if(request()->get("y_job_position") != "") {
                $whereData = request()->get('y_job_position'); 
                $totalData = Student::where('work_place', $x_work_place)->where('job_position', $whereData)->count(); 
                array_push($datasets_job_position, $totalData); 
            }

            if(request()->get("y_work_industry") != "") {
                $whereData = request()->get('y_work_industry'); 
                $totalData = Student::where('work_place', $x_work_place)->where('work_industry', $whereData)->count(); 
                array_push($datasets_work_industry, $totalData); 
            }

            if(request()->get("y_work_sector") != "") {
                $whereData = request()->get('y_work_sector'); 
                $totalData = Student::where('work_place', $x_work_place)->where('work_sector', $whereData)->count(); 
                array_push($datasets_work_sector, $totalData); 
            }

            if(request()->get("y_school") != "") {
                $whereData = request()->get('y_school'); 
                $totalData = Student::where('work_place', $x_work_place)->where('school_id', $whereData)->count(); 
                array_push($datasets_school, $totalData); 
            }

            if(request()->get("y_year_graduated") != "") {
                $whereData = request()->get('y_year_graduated'); 
                $totalData = Student::where('work_place', $x_work_place)->where('year_graduated', $whereData)->count(); 
                array_push($datasets_year_graduated, $totalData); 
            }

            if ($y_age = request()->get('y_age') && request()->get('y_age') != "") {
                $ageData = 0; 
                $studentAgeList = Student::where('work_place', $x_work_place)->get(); 
                foreach ($studentAgeList as $student ) {
                    if ($y_age == 'teen' && ($student->age >= 13 && $student->age <= 19 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'youth' && ($student->age >= 20 && $student->age <= 25 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'adult' && ($student->age >= 26 ) ) {            
                        $ageData++;
                    }
                }
                array_push($datasets_age, $ageData);  
            }

            array_push($labels, 'Work Place - ' . $x_work_place);
            array_push($datasets, $workPlaceData);
        }

        if(request()->get("x_work_industry") != "") {
            $x_work_industry = request()->get('x_work_industry'); 
            $workIndustryData = Student::where('work_industry', $x_work_industry)->count();
            
            if(request()->get('y_degree') != ""){
                $whereData = $this->convertDegree(request()->get('y_degree'));
                $totalData = Student::where('work_industry', $x_work_industry)->where('degree', $whereData)->count(); 
                array_push($datasets_degree, $totalData); 
            }
            
            if(request()->get("y_company") != "") {
                $whereData = request()->get('y_company'); 
                $totalData = Student::where('work_industry', $x_work_industry)->where('company_id', $whereData)->count();  
                array_push($datasets_company, $totalData); 
            }
            
            if(request()->get("y_employment_status") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::where('work_industry', $x_work_industry)->where('employment_status', $whereData)->count();  
                array_push($datasets_employment_status, $totalData); 
            }
            
            if(request()->get("y_job_role") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::where('work_industry', $x_work_industry)->where('job_role', $whereData)->count(); 
                array_push($datasets_job_role, $totalData); 
            }
            
            if(request()->get("y_job_position") != "") {
                $whereData = request()->get('y_job_position'); 
                $totalData = Student::where('work_industry', $x_work_industry)->where('job_position', $whereData)->count(); 
                array_push($datasets_job_position, $totalData); 
            }

            if(request()->get("y_work_place") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::where('work_industry', $x_work_industry)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_place, $totalData); 
            }

            if(request()->get("y_work_sector") != "") {
                $whereData = request()->get('y_work_sector'); 
                $totalData = Student::where('work_industry', $x_work_industry)->where('work_sector', $whereData)->count(); 
                array_push($datasets_work_sector, $totalData); 
            }

            if(request()->get("y_school") != "") {
                $whereData = request()->get('y_school'); 
                $totalData = Student::where('work_industry', $x_work_industry)->where('school_id', $whereData)->count(); 
                array_push($datasets_school, $totalData); 
            }

            if(request()->get("y_year_graduated") != "") {
                $whereData = request()->get('y_year_graduated'); 
                $totalData = Student::where('work_industry', $x_work_industry)->where('year_graduated', $whereData)->count(); 
                array_push($datasets_year_graduated, $totalData); 
            }

            if ($y_age = request()->get('y_age') && request()->get('y_age') != "") {
                $ageData = 0; 
                $studentAgeList = Student::where('work_industry', $x_work_industry)->get(); 
                foreach ($studentAgeList as $student ) {
                    if ($y_age == 'teen' && ($student->age >= 13 && $student->age <= 19 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'youth' && ($student->age >= 20 && $student->age <= 25 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'adult' && ($student->age >= 26 ) ) {            
                        $ageData++;
                    }
                }
                array_push($datasets_age, $ageData);  
            }

            array_push($labels, 'Work Industry - ' . $x_work_industry);
            array_push($datasets, $workIndustryData);
        }

        if(request()->get("x_work_sector") != "") {
            $x_work_sector = request()->get('x_work_sector'); 
            $workSectorData = Student::where('work_sector', $x_work_sector)->count();
            
            if(request()->get('y_degree') != ""){
                $whereData = $this->convertDegree(request()->get('y_degree'));
                $totalData = Student::where('work_sector', $x_work_sector)->where('degree', $whereData)->count(); 
                array_push($datasets_degree, $totalData); 
            }
            
            if(request()->get("y_company") != "") {
                $whereData = request()->get('y_company'); 
                $totalData = Student::where('work_sector', $x_work_sector)->where('company_id', $whereData)->count();  
                array_push($datasets_company, $totalData); 
            }
            
            if(request()->get("y_employment_status") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::where('work_sector', $x_work_sector)->where('employment_status', $whereData)->count();  
                array_push($datasets_employment_status, $totalData); 
            }
            
            if(request()->get("y_job_role") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::where('work_sector', $x_work_sector)->where('job_role', $whereData)->count(); 
                array_push($datasets_job_role, $totalData); 
            }
            
            if(request()->get("y_job_position") != "") {
                $whereData = request()->get('y_job_position'); 
                $totalData = Student::where('work_sector', $x_work_sector)->where('job_position', $whereData)->count(); 
                array_push($datasets_job_position, $totalData); 
            }

            if(request()->get("y_work_place") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::where('work_sector', $x_work_sector)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_place, $totalData); 
            }

            if(request()->get("y_work_industry") != "") {
                $whereData = request()->get('y_work_industry'); 
                $totalData = Student::where('work_sector', $x_work_sector)->where('work_industry', $whereData)->count(); 
                array_push($datasets_work_industry, $totalData); 
            }

            if(request()->get("y_school") != "") {
                $whereData = request()->get('y_school'); 
                $totalData = Student::where('work_sector', $x_work_sector)->where('school_id', $whereData)->count(); 
                array_push($datasets_school, $totalData); 
            }

            if(request()->get("y_year_graduated") != "") {
                $whereData = request()->get('y_year_graduated'); 
                $totalData = Student::where('work_sector', $x_work_sector)->where('year_graduated', $whereData)->count(); 
                array_push($datasets_year_graduated, $totalData); 
            }

            if ($y_age = request()->get('y_age') && request()->get('y_age') != "") {
                $ageData = 0; 
                $studentAgeList = Student::where('work_sector', $x_work_sector)->get(); 
                foreach ($studentAgeList as $student ) {
                    if ($y_age == 'teen' && ($student->age >= 13 && $student->age <= 19 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'youth' && ($student->age >= 20 && $student->age <= 25 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'adult' && ($student->age >= 26 ) ) {            
                        $ageData++;
                    }
                }
                array_push($datasets_age, $ageData);  
            }

            array_push($labels, 'Job Position - ' . $x_work_sector);
            array_push($datasets, $workSectorData);
        }
        
        if(request()->get('x_school') != ""){
            $x_school = request()->get('x_school');
            $schoolName = School::find($x_school)->name;
            $schoolData = Student::where('school_id', $x_school)->count(); 
            
            if(request()->get('y_degree') != ""){
                $whereData = $this->convertDegree(request()->get('y_degree'));
                $totalData = Student::where('school_id', $x_school)->where('degree', $whereData)->count(); 
                array_push($datasets_degree, $totalData); 
            }
            
            if(request()->get("y_company") != "") {
                $whereData = request()->get('y_company'); 
                $totalData = Student::where('school_id', $x_school)->where('company_id', $whereData)->count();  
                array_push($datasets_company_id, $totalData); 
            }
            
            if(request()->get("y_employment_status") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::where('school_id', $x_school)->where('employment_status', $whereData)->count();  
                array_push($datasets_employment_status, $totalData); 
            }
            
            if(request()->get("y_job_role") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::where('school_id', $x_school)->where('job_role', $whereData)->count(); 
                array_push($datasets_job_role, $totalData); 
            }
            
            if(request()->get("y_job_position") != "") {
                $whereData = request()->get('y_job_position'); 
                $totalData = Student::where('school_id', $x_school)->where('job_position', $whereData)->count(); 
                array_push($datasets_job_position, $totalData); 
            }

            if(request()->get("y_work_place") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::where('school_id', $x_school)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_place, $totalData); 
            }

            if(request()->get("y_work_industry") != "") {
                $whereData = request()->get('y_work_industry'); 
                $totalData = Student::where('school_id', $x_school)->where('work_industry', $whereData)->count(); 
                array_push($datasets_work_industry, $totalData); 
            }

            if(request()->get("y_work_sector") != "") {
                $whereData = request()->get('y_work_sector'); 
                $totalData = Student::where('school_id', $x_school)->where('work_sector', $whereData)->count(); 
                array_push($datasets_work_sector, $totalData); 
            }

            if(request()->get("y_year_graduated") != "") {
                $whereData = request()->get('y_year_graduated'); 
                $totalData = Student::where('school_id', $x_school)->where('year_graduated', $whereData)->count(); 
                array_push($datasets_year_graduated, $totalData); 
            }

            if ($y_age = request()->get('y_age') && request()->get('y_age') != "") {
                $ageData = 0; 
                $studentAgeList = Student::where('school_id', $x_school)->get(); 
                foreach ($studentAgeList as $student ) {
                    if ($y_age == 'teen' && ($student->age >= 13 && $student->age <= 19 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'youth' && ($student->age >= 20 && $student->age <= 25 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'adult' && ($student->age >= 26 ) ) {            
                        $ageData++;
                    }
                }
                array_push($datasets_age, $ageData);  
            }


            array_push($labels, 'School - ' . $schoolName);
            array_push($datasets, $schoolData);
        }

        if(request()->get("x_year_graduated") != "") {
            $x_year_graduated = request()->get('x_year_graduated'); 
            $yearGraduatedData = Student::where('year_graduated', $x_year_graduated)->count();
            
            
            if(request()->get('y_degree') != ""){
                $whereData = $this->convertDegree(request()->get('y_degree'));
                $totalData = Student::where('year_graduated', $x_year_graduated)->where('degree', $whereData)->count(); 
                array_push($datasets_degree, $totalData); 
            }
            
            if(request()->get("y_company") != "") {
                $whereData = request()->get('y_company'); 
                $totalData = Student::where('year_graduated', $x_year_graduated)->where('company_id', $whereData)->count();  
                array_push($datasets_company_id, $totalData); 
            }
            
            if(request()->get("y_employment_status") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::where('year_graduated', $x_year_graduated)->where('employment_status', $whereData)->count();  
                array_push($datasets_employment_status, $totalData); 
            }
            
            if(request()->get("y_job_role") != "") {
                $whereData = request()->get('y_job_role'); 
                $totalData = Student::where('year_graduated', $x_year_graduated)->where('job_role', $whereData)->count(); 
                array_push($datasets_job_role, $totalData); 
            }
            
            if(request()->get("y_job_position") != "") {
                $whereData = request()->get('y_job_position'); 
                $totalData = Student::where('year_graduated', $x_year_graduated)->where('job_position', $whereData)->count(); 
                array_push($datasets_job_position, $totalData); 
            }

            if(request()->get("y_work_place") != "") {
                $whereData = request()->get('y_work_place'); 
                $totalData = Student::where('year_graduated', $x_year_graduated)->where('work_place', $whereData)->count(); 
                array_push($datasets_work_place, $totalData); 
            }

            if(request()->get("y_work_industry") != "") {
                $whereData = request()->get('y_work_industry'); 
                $totalData = Student::where('year_graduated', $x_year_graduated)->where('work_industry', $whereData)->count(); 
                array_push($datasets_work_industry, $totalData); 
            }

            if(request()->get("y_work_sector") != "") {
                $whereData = request()->get('y_work_sector'); 
                $totalData = Student::where('year_graduated', $x_year_graduated)->where('work_sector', $whereData)->count(); 
                array_push($datasets_work_sector, $totalData); 
            }

            if(request()->get("y_school") != "") {
                $whereData = request()->get('y_school'); 
                $totalData = Student::where('year_graduated', $x_year_graduated)->where('school_id', $whereData)->count(); 
                array_push($datasets_school, $totalData); 
            }

            if ($y_age = request()->get('y_age') && request()->get('y_age') != "") {
                $ageData = 0; 
                $studentAgeList = Student::where('year_graduated', $x_year_graduated)->get(); 
                foreach ($studentAgeList as $student ) {
                    if ($y_age == 'teen' && ($student->age >= 13 && $student->age <= 19 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'youth' && ($student->age >= 20 && $student->age <= 25 ) ) {            
                        $ageData++;
                    }
                    if ($y_age == 'adult' && ($student->age >= 26 ) ) {            
                        $ageData++;
                    }
                }
                array_push($datasets_age, $ageData);  
            }

            array_push($labels, 'Year Graduated - ' . $x_year_graduated);
            array_push($datasets, $yearGraduatedData);
        }
        

        $colorCodes = ['#C0C0C0', "#808080", "#000000", "#FF0000", "#800000", "#FFFF00", "#808000", "#00FF00", "#008000", "#00FFFF", "#008080", "#0000FF", "#000080", "#FF00FF", "#800080"];
        $chart->labels($labels);
        $request = request();
        if ($request['y_company']) {
            $colored = $colorCodes[ rand(0, (sizeof($colorCodes)-1)) ];
            $company = Company::find($request['y_company'])->name;
            $chart->dataset('Company - ' . $company, 'bar', $datasets_company)
                        ->backgroundColor($colored)
                        ->color($colored);
        } 
        if ($request['y_degree']) {
            $colored = $colorCodes[ rand(0, (sizeof($colorCodes)-1)) ];
            $chart->dataset('Degree - ' . $request['y_degree'], 'bar', $datasets_degree)
                        ->backgroundColor($colored)
                        ->color($colored);
        } 
        if ($request['y_age']) { 
            $colored = $colorCodes[ rand(0, (sizeof($colorCodes)-1)) ];
            $chart->dataset('Age - '. $request['y_age'], 'bar', $datasets_age)
                    ->backgroundColor($colored)
                    ->color($colored);
        } 
        if ($request['y_employment_status']) {
            $colored = $colorCodes[ rand(0, (sizeof($colorCodes)-1)) ];
            $chart->dataset('Employment Status - ' . $request['y_employment_status'], 'bar', $datasets_employment_status)
            ->backgroundColor($colored)
            ->color($colored);
        }
        if ($request['y_job_role']) {
            $colored = $colorCodes[ rand(0, (sizeof($colorCodes)-1)) ];
            $chart->dataset('Job Role - '. $request['y_job_role'], 'bar', $datasets_job_role)
            ->backgroundColor($colored)
            ->color($colored);
        }
        if ($request['y_job_position']) {
            $colored = $colorCodes[ rand(0, (sizeof($colorCodes)-1)) ];
            $chart->dataset('Job Position - '. $request['y_job_position'], 'bar', $datasets_job_position)
            ->backgroundColor($colored)
            ->color($colored);
        }
        if ($request['y_work_place']) {
            $colored = $colorCodes[ rand(0, (sizeof($colorCodes)-1)) ];
            $chart->dataset('Work Place - ' . $request['y_work_place'], 'bar', $datasets_work_place)
            ->backgroundColor($colored)
            ->color($colored);
        }
        if ($request['y_work_industry']) {
            $colored = $colorCodes[ rand(0, (sizeof($colorCodes)-1)) ];
            $chart->dataset('Work Industry - ' . $request['y_work_industry'], 'bar', $datasets_work_industry)
            ->backgroundColor($colored)
            ->color($colored);
        }
        if ($request['y_work_sector']) {
            $colored = $colorCodes[ rand(0, (sizeof($colorCodes)-1)) ];
            $chart->dataset('Work Sector - ' . $request['y_work_sector'], 'bar', $datasets_work_sector)
            ->backgroundColor($colored)
            ->color($colored);
        }
        if ($request['y_school']) {
            $colored = $colorCodes[ rand(0, (sizeof($colorCodes)-1)) ];
            $school = School::find($request['y_school'])->name;
            $chart->dataset('School - ' . $school , 'bar', $datasets_school)
            ->backgroundColor($colored)
            ->color($colored);
        }
        if ($request['y_year_graduated']) {
            $colored = $colorCodes[ rand(0, (sizeof($colorCodes)-1)) ];
            $chart->dataset('Year Graduated - ' . $request['y_year_graduated'], 'bar', $datasets_year_graduated)
            ->backgroundColor($colored)
            ->color($colored);
        }

        if($dataSetCount == 0){
            $colored = $colorCodes[ rand(0, (sizeof($colorCodes)-1)) ];
            $chart->dataset('X-Data', 'bar', $datasets)->backgroundColor($colored)
            ->color($colored); 

        } 
        
        return view('custom.report.show',[
            'chart' => $chart,
            'companies' => $companies,
            'schools' => $schools,
            'job_positions' => $job_positions,
        ]);
    }

    public function convertDegree($degree) {
        switch($degree){
            case 'shs' : 
                    return 'Senior High School';
            case 'college': return 'College Degree';
            case 'masters': return 'Master\s Degree';
            case 'doctorate' : return 'Doctorate Degree';
            default : return '';
        }
    }

    public function checkYData( ){
        $request = request(); 
        $cnt = 0;
        if ($request['y_company']) $cnt++; 
        if ($request['y_age']) $cnt++;
        if ($request['y_degree']) $cnt++;
        if ($request['y_employment_status']) $cnt++;
        if ($request['y_job_role']) $cnt++;
        if ($request['y_job_position']) $cnt++;
        if ($request['y_work_place']) $cnt++;
        if ($request['y_work_industry']) $cnt++;
        if ($request['y_work_sector']) $cnt++;
        if ($request['y_school']) $cnt++;
        if ($request['y_year_graduated']) $cnt++;

        return $cnt; 
    }

    public function getYDegree(){
        // if(request()->get('y_degree') != ""){ 
        // }
    }
}
