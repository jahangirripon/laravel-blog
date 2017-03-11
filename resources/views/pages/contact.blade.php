@extends('main')
@section('title', '| Contact')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="post">
                    <h3>Contact me</h3>
                    <hr>
                    <form action="{{ url('contact')}}" method="POST">

                    {{ csrf_field() }}
                        <div class="form-group">
                            <label name="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label name="subject">subject</label>
                            <input type="text" name="subject" id="subject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label name="message">Message</label>
                            <textarea id="message" name="message" class="form-control"></textarea>
                        </div>
                        <input type="submit" name="submit" value="submit" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
@endsection