@extends(backpack_view('blank'))

@section('header')
	<section class="container-fluid">
	  <h2>
            <span class="text-capitalize">Reports</span>
	  </h2>
    </section>
    <hr>
@endsection

@section('content')
<div class="animated fadeIn">
    <form>
        <div class="row">
            <div class="col col-md-6 col-sm-12">
                
                <div class="card bg-danger">
                    <div class="card-header">
                        <h3 class="text-capitalize text-title">
                                X-Data Interpretation
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select name="x_company" id="x_company" class="form-control">
                                        <option value="" selected>Select Company</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    
                                    <select class="form-control" name="x_gender" id="x_gender">
                                        <option value="" selected>Select Sex</option>
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select name="x_age" id="x_age" class="form-control">
                                        <option value="" selected>Select Age</option>
                                        <option value="teens">Teens(13-19)</option>
                                        <option value="youth">Youth(20-25)</option>
                                        <option value="adult">Adult(25+)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select name="x_degree" id="x_degree" class="form-control">
                                        <option value="" selected>Select Degree</option>
                                        <option value="shs">Senior High School</option>
                                        <option value="college">College Degree</option>
                                        <option value="masters">Master's Degree</option>
                                        <option value="doctorate">Doctorate Degree</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select name="x_employment_status" id="x_employment_status" class="form-control">
                                        <option value="" selected>  Select Employment Status</option>
                                        <option value="Regular">Regular </option>
                                        <option value="Contractual">Contractual</option>
                                        <option value="Temporary">Temporary</option>
                                        <option value="Self-Employed">Self-Employed</option>
                                        <option value="Unemployed">Unemployed</option>   
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select name="x_job_role" id="x_job_role" class="form-control">
                                        <option value="" selected>  Select Job Role</option>
                                        <option value="executive">Executive </option>
                                        <option value="manager">Manager</option>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="entry_level">Entry level</option>
                                        <option value="internship">Internship</option>   
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select name="x_job_position" id="x_job_position" class="form-control">
                                        <option value="" selected>  Select Job Position</option> 
                                        @foreach($job_positions as $jb)
                                            <option value="{{ $jb }}">{{ $jb }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select name="x_work_place" id="x_work_place" class="form-control">
                                        <option value="" selected>  Select Place of Work</option>
                                        <option value="overseas">Overseas </option>
                                        <option value="non-overseas">Non-overseas </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select name="x_work_industry" id="x_work_industry" class="form-control">
                                    <option value="" selected>  Select Work Industry</option>
                                        <option value="IT,BPO and Business Services">IT,BPO and Business Services</option>
                                        <option value="Manufacturing">Manufacturing</option>
                                        <option value="Banking and Finance">Banking and Finance</option>
                                        <option value="Gaming">Gaming</option>
                                        <option value="">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select name="x_work_sector" id="x_work_sector" class="form-control">
                                        <option value="" selected>  Select Work Sector</option>
                                        <option value="Government">Government </option>
                                        <option value="Non-government">Non-government</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select name="x_school" id="x_school" class="form-control">
                                        <option value="" selected>Select School</option> 
                                        @foreach($schools as $school)
                                            <option value="{{ $school->id }}">{{ $school->name }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="number" name="x_year_graduated" class="form-control" placeholder="Enter Year Graduated" min="1900">
                                </div>
                            </div>
                        </div>
                            
                    </div>
                    <div class="card-footer">
                        
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-success">Generate</button>
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="col col-md-6 col-sm-12">
                
                <div class="card bg-warning">
                    <div class="card-header">
                        <h3 class="text-capitalize text-title">
                            Y-Data Interpretation
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select name="y_company" id="y_company" class="form-control">
                                        <option value="" selected>Select Company</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select name="y_age" id="y_age" class="form-control">
                                        <option value="" selected>Select Age</option>
                                        <option value="teens">Teens(13-19)</option>
                                        <option value="youth">Youth(20-25)</option>
                                        <option value="adult">Adult(25+)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select name="y_degree" id="y_degree" class="form-control">
                                        <option value="" selected>Select Degree</option>
                                        <option value="shs">Senior High School</option>
                                        <option value="college">College Degree</option>
                                        <option value="masters">Master's Degree</option>
                                        <option value="doctorate">Doctorate Degree</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select name="y_employment_status" id="y_employment_status" class="form-control">
                                        <option value="" selected>  Select Employment Status</option>
                                        <option value="Regular">Regular </option>
                                        <option value="Contractual">Contractual</option>
                                        <option value="Temporary">Temporary</option>
                                        <option value="Self-Employed">Self-Employed</option>
                                        <option value="Unemployed">Unemployed</option>   
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select name="y_job_role" id="y_job_role" class="form-control">
                                        <option value="" selected>  Select Job Role</option>
                                        <option value="executive">Executive </option>
                                        <option value="manager">Manager</option>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="entry_level">Entry level</option>
                                        <option value="internship">Internship</option>   
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select name="y_job_position" id="y_job_position" class="form-control">
                                        <option value="" selected>  Select Job Position</option> 
                                        @foreach($job_positions as $jb)
                                            <option value="{{ $jb }}">{{ $jb }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select name="y_work_place" id="y_work_place" class="form-control">
                                        <option value="" selected>  Select Place of Work</option>
                                        <option value="overseas">Overseas </option>
                                        <option value="non-overseas">Non-overseas </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select name="y_work_industry" id="y_work_industry" class="form-control">
                                    <option value="" selected>  Select Work Industry</option>
                                        <option value="IT,BPO and Business Services">IT,BPO and Business Services</option>
                                        <option value="Manufacturing">Manufacturing</option>
                                        <option value="Banking and Finance">Banking and Finance</option>
                                        <option value="Gaming">Gaming</option>
                                        <option value="">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select name="y_work_sector" id="y_work_sector" class="form-control">
                                        <option value="" selected>  Select Work Sector</option>
                                        <option value="Government">Government </option>
                                        <option value="Non-government">Non-government</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select name="y_school" id="y_school" class="form-control">
                                        <option value="" selected>Select School</option> 
                                        @foreach($schools as $school)
                                            <option value="{{ $school->id }}">{{ $school->name }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="number" name="y_year_graduated" class="form-control" placeholder="Enter Year Graduated" min="1900">
                                </div>
                            </div>
                        </div>
                            
                    </div>
                    <div class="card-footer">
                        
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-success">Generate</button>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
        
    </form>
    <div class="row">
        <div class="col">
            
            <div class="chart-wrapper" style="height:300px;margin-top:40px;width: 100%;">
                {!! $chart->container() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('after_styles')
  <!-- DATA TABLES -->
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css') }}">
  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/form.css') }}">
  <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/list.css') }}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
      
  <!-- CRUD LIST CONTENT - crud_list_styles stack -->
  @stack('crud_list_styles')
@endsection

@section('after_scripts')
 
    <script src="https://backstrap.net/vendors/chart.js/js/Chart.min.js"></script>
    <script src="https://backstrap.net/vendors/@coreui/coreui-plugin-chartjs-custom-tooltips/js/custom-tooltips.min.js"></script>
    <script src="https://backstrap.net/js/main.js"></script>
    <script src="{{ asset('packages/backpack/crud/js/crud.js') }}"></script>
    <script src="{{ asset('packages/backpack/crud/js/form.js') }}"></script>
    <script src="{{ asset('packages/backpack/crud/js/list.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    
    <script>
     
        $('#caregivers').selectpicker();
        $('#caregivers').selectpicker('refresh');
    </script>
    <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
    @stack('crud_list_scripts')

    {!! $chart->script() !!}
    
@endsection

