@extends('main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Mail list</h3> 
                </div>
                <div class="panel-body">
                    <div class=" col-md-12 col-sm-12 col-xs-12">
                        <form class="form-horizontal" method="POST" action="{{ route('maillist') }}">
                            <br/>
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                 

                                </div>
                            </div>

                            <?php
                                    if(isset($_POST['name'])){
                                       if(isset($_POST['email']))
                                    {
                                   $data= [];
                                   $name=$_POST['name'];
                                   $space=' ';
                                   $email=$_POST['email'].PHP_EOL;
                                   $fp = fopen('/var/www/html/awsmonitor/modules/analyzer/wimea_analyzer_python/stations/contacts.txt', 'a');
                                   fwrite($fp, $name);
                                   fwrite($fp, $space);
                                   fwrite($fp, $email);
                                   fclose($fp);
                                  }
                                }
                                    ?>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
