<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Blog @yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/css/parsley.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>

  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'link lists image',
      menubar: false
    });
  </script>
    {{ Html::style('css/style.css')}}
    {{ Html::style('css/select2.min.css')}}
  </head>
  <body>

    <nav class="navbar navbar-default navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">MyBlog</a>
    </div>
    <div class="collapse navbar-collapse navbar-inverse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="{{ Request::is('/') ? "active" : "" }}"><a href="{{URL::to('/')}}">Home <span class="sr-only">(current)</span></a></li>
        <li class="{{ Request::is('blog') ? "active" : "" }}"><a href="{{URL::to('/blog')}}">Blog</a></li>
        <li class="{{ Request::is('contact') ? "active" : "" }}"><a href="{{URL::to('/contact')}}">Contact</a></li>
        <li class="{{ Request::is('about') ? "active" : "" }}"><a href="{{URL::to('/about')}}">About</a></li>
        <li class="{{ Request::is('/posts/create') ? "active" : "" }}"><a href="{{URL::to('/posts/create')}}">Create</a></li>
        <li class="{{ Request::is('posts') ? "active" : "" }}"><a href="{{URL::to('/posts')}}">All Posts</a></li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">


        <li class="dropdown">
          <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route ('posts.index')}}">Posts</a></li>
            <li><a href="{{ route ('categories.index')}}">Categories</a></li>
            <li><a href="{{ route ('tags.index')}}">Tags</a></li>
            <li role="separator" class="divider"></li>
           
          </ul>
        </li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    <div class="container">

    @include('partials._messages')

      @yield('content')
      <hr>
      <p class="text-center">Copyright Jahangir Ripon</p>
    </div>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>