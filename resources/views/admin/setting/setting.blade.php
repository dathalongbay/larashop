@extends('admin.layouts.admin')

@section('title', 'Banner')

@section('content')
    <div class='col-lg-10'>

        @if(Session::has('flash_message'))
            <div class="container">
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                </div>
            </div>
        @endif

        <h1>Setting</h1>
        <hr>
        @include ('admin.errors.list')

        {{ Form::model($setting, array('route' => array('settings.update', 1), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}


        <div class="form-group">

            <h1>Global setting</h1>

            <div class="form-group">
                {{ Form::label('logo', 'Logo') }}
                <div class="input-group">
               <span class="input-group-btn">
                 <a id="lfm-logo" data-input="logo" data-preview="holder-logo" class="lfm btn btn-primary">
                   <i class="fa fa-picture-o"></i> Choose
                 </a>
               </span>
                    <input id="logo" name="logo" class="form-control" type="text" name="filepath" value="<?php echo $setting['logo'] ?>">
                </div>
                @if ($setting['logo'])
                    <img id="holder-logo" src="<?php echo url($setting['logo']) ?>" style="margin-top:15px;max-height:100px;">
                @else
                    <img id="holder-logo" style="margin-top:15px;max-height:100px;">
                @endif

            </div>

            <div class="form-group">
                {{ Form::label('favicon', 'Favicon') }}
                <div class="input-group">
               <span class="input-group-btn">
                 <a id="lfm-favicon" data-input="favicon" data-preview="holder-favicon" class="lfm btn btn-primary">
                   <i class="fa fa-picture-o"></i> Choose
                 </a>
               </span>
                    <input id="favicon" name="favicon" class="form-control" type="text" name="filepath" value="<?php echo $setting['favicon'] ?>">
                </div>

                @if ($setting['logo'])
                    <img id="holder-favicon" src="<?php echo url($setting['favicon']) ?>" style="margin-top:15px;max-height:100px;">
                @else
                    <img id="holder-favicon" style="margin-top:15px;max-height:100px;">
                @endif
            </div>

            <div class="form-group">
                {{ Form::label('slider_top', 'Slider top') }}
                {{ Form::text('slider_top', null, array('class' => 'form-control')) }}
            </div>


            <hr>
            <h1>Header setting</h1>

            <div class="form-group">
                {{ Form::label('header_msg_1', 'Header top message 1') }}
                {{ Form::text('header_msg_1', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('header_msg_2', 'Header top message 2') }}
                {{ Form::text('header_msg_2', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('header_msg_3', 'Header top message 3') }}
                {{ Form::text('header_msg_3', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('facebook', 'Facebook url') }}
                {{ Form::text('facebook', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('twiter', 'Twiter url') }}
                {{ Form::text('twiter', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('instagram', 'Instagram url') }}
                {{ Form::text('instagram', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('youtube', 'Youtube url') }}
                {{ Form::text('youtube', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('header_menu', 'Header menu') }}
                {{ Form::text('header_menu', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('slider_homepage', 'Slider homepage') }}
                {{ Form::text('slider_homepage', null, array('class' => 'form-control')) }}
            </div>

            <hr>
            <h1>Process shopping setting</h1>

            <div class="form-group">
                {{ Form::label('process_title', 'Process title') }}
                {{ Form::text('process_title', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('process_step_1', 'Process step 1') }}
                {{ Form::text('process_step_1', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('process_step_1_desc', 'Process step 1 description') }}
                {{ Form::textarea('process_step_1_desc', null, array('class' => 'form-control lara-mce')) }}<br>
            </div>

            <div class="form-group">
                {{ Form::label('process_step_2', 'Process step 2') }}
                {{ Form::text('process_step_2', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('process_step_2_desc', 'Process step 2 description') }}
                {{ Form::textarea('process_step_2_desc', null, array('class' => 'form-control lara-mce')) }}<br>
            </div>

            <div class="form-group">
                {{ Form::label('process_step_3', 'Process step 3') }}
                {{ Form::text('process_step_3', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('process_step_3_desc', 'Process step 3 description') }}
                {{ Form::textarea('process_step_3_desc', null, array('class' => 'form-control lara-mce')) }}<br>
            </div>

            <hr>
            <h1>Footer setting</h1>


            <div class="form-group">
                {{ Form::label('contact_address', 'Contact address') }}
                {{ Form::text('contact_address', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('contact_mail', 'Contact mail') }}
                {{ Form::text('contact_mail', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('contact_phone', 'Contact phone') }}
                {{ Form::text('contact_phone', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('flicker', 'Flicker') }}
                {{ Form::text('flicker', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('footer_desc', 'Footer description') }}
                {{ Form::textarea('footer_desc', null, array('class' => 'form-control lara-mce')) }}<br>
            </div>

            <div class="form-group">
                {{ Form::label('copyright', 'Footer copyright') }}
                {{ Form::textarea('copyright', null, array('class' => 'form-control lara-mce')) }}<br>
            </div>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>
    </div>
@endsection