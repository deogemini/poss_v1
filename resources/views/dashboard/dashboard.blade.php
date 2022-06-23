@extends('layouts.app')

@section('content')

<div class="wrapper">
  <nav id="sidebar">
    <div class="sidebar-header">
      <h3>Bootstrap Slider</h3>
       
    </div>
    <ul class="list-unstyled components">
      <p>The Providers</p>
      <li class="active">
        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
        <ul class="collapse list-unstyled" id="homeSubmenu">
          <li> 
            <a href="#">Home1</a>
          </li>
          <li> 
            <a href="#">Home1</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="">About</a>
      </li>
      <li>
        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
        <ul class="collapse list-unstyled" id="pageSubmenu">
          <li>
            <a href="#">Page 1</a>
          </li>
          <li>
            <a href="#">Page 2</a>
          </li>
        </ul>
      </li>
      <li>
            <a href="#">Page 2</a>
      </li> 
      <li>
            <a href="#">Page 2</a>
      </li>

    </ul>

  </nav>
  <div id="content">
    <nav class="navbar navbar-expand-lg navbarlight bg-light">
      <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-info">
          <i class="fa fa-align-left">
          </i>
          <span>Toggle Sidebar</span>
        </button>

      </div>
    </nav>
    <br><br>
    <h2>Collapseible Sidebar using Bootstrap 4</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum sunt tenetur et enim assumenda? Ut veritatis eveniet minima assumenda ipsum reiciendis maxime provident harum ipsam.</p>
<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Optio suscipit impedit, consectetur autem, quaerat tenetur, quam dolores quo incidunt dignissimos aliquid ullam ab voluptate! Omnis!</p>
  <div class="line"></div>
  <h3>Lorem ipsum dolor sit amet consectetur adipisicing.</h3>
  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Optio suscipit impedit, consectetur autem, quaerat tenetur, quam dolores quo incidunt dignissimos aliquid ullam ab voluptate! Omnis!</p>

  
</div>


@endsection
