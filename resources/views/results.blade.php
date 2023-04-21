@extends('layouts.site-layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--<section>-->
<!--<div style="background-color:#212529" class="px-5">-->
<!--                <div class="row gx-5 justify-content-center">-->
<!--                    <div class="col-lg-6">-->
<!--                        <div class="text-center my-5">-->
<!--                            <h1 class="display-5 py-4 fw-bolder text-white mb-2">Privacy Policy</h1>-->
<!--                            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">-->
<!--                                <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#events">Events</a>-->
<!--                                <a class="btn btn-outline-light btn-lg px-4" href="#!">Learn More</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--</section>-->
<style>
    thead {
       background-color: #cc1400!important;
       color:#ffffff!important;
    }
    .card-header {
        font-weight:bold!important;
    }
</style>
<section class="border-bottom" id="about">
    <div class="container px-5 my-5">
        <div class="row gx-4 gx-lg-5">
            <div class="col-md-12">
              <h1 class="text-center">Norther Qualifer Results</h1>
              
              <!--Start Table-->
              
              
              <div class="card mt-5">
  <div class="card-header" style="background-color:#091b85; color:#ffffff;">
    Northern Qualifer Day 1 Results
  </div>
  <div class="card-body">
    <!--<h5 class="card-title">Special title treatment</h5>-->
    <div class="table-responsive">
   <table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Place</th>
      <th scope="col">Team</th>
      <th scope="col">Fish</th>
      <th scope="col">Wgt</th>
       <th scope="col">Pnity</th>
      <th scope="col">B/F</th>
      <th scope="col">Total</th>
      <th scope="col">Points</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>NATHAN TROYANEK-JEFF CROWLEY</td>
      <td>5/5</td>
      <td>25.14</td>
      <td></td>
      <td>6.52</td>
      <td>25.14</td>
    </tr>
    
     <tr>
      <th scope="row">2</th>
      <td>MIKE TROMBLY-MARK MODRAK</td>
      <td>5/5</td>
      <td>24.51</td>
      <td></td>
      <td>5.85</td>
      <td>24.51</td>
    </tr>
    
      <tr>
      <th scope="row">3</th>
      <td>TREVOR JANCASZ-KEVIN VITAK</td>
      <td>5/5</td>
      <td>24.39</td>
      <td></td>
      <td>5.88</td>
      <td>24.39</td>
    </tr>
    
    <tr>
      <th scope="row">4</th>
      <td>BEN NOWAK-NATHEN DERDOWSKI</td>
      <td>5/5</td>
      <td>21.38</td>
      <td></td>
      <td>5.53</td>
      <td>21.38</td>
    </tr>
     <tr>
      <th scope="row">5</th>
      <td>BILL HORTON-*KIM OSTRANDER</td>
      <td>5/5</td>
      <td>21.34</td>
      <td></td>
      <td>5.99</td>
      <td>21.34</td>
    </tr>
    
     <tr>
      <th scope="row">6</th>
      <td>DON BOBO-SEAN HUPP</td>
      <td>3/3</td>
      <td>14.92</td>
      <td></td>
      <td>6.66</td>
      <td>14.92</td>
    </tr>
    
    <tr>
      <th scope="row">7</th>
      <td>ELI JAIME-AVERY MARROW</td>
      <td>5/5</td>
      <td>14.28</td>
      <td></td>
      <td>5.09</td>
      <td>14.28</td>
    </tr>
    
    <tr>
      <th scope="row">8</th>
      <td>SHAYNE CLEVELAND-KENNETH CLEVELAND</td>
      <td>1/1</td>
      <td>4.25</td>
      <td></td>
      <td>4.25</td>
      <td>4.25</td>
    </tr>
    
     <tr>
      <th scope="row">9</th>
      <td>ROBERT GROSSE-RICHARD GROSS</td>
      <td></td>
      <td>.00</td>
      <td></td>
      <td></td>
      <td>.00</td>
    </tr>
    
    
     <tr>
      <th scope="row">9</th>
      <td>WILLIAM HUGHES-JOE HERRON</td>
      <td></td>
      <td>.00</td>
      <td></td>
      <td></td>
      <td>.00</td>
    </tr>
     <tr>
      <th scope="row">9</th>
      <td>CHASE SARIFIN-NICHOLAS CZAJAK</td>
      <td></td>
      <td>.00</td>
      <td></td>
      <td></td>
      <td>.00</td>
    </tr>
    
    
    <!-- <tr>-->
    <!--  <td colspan="4">Teams Fished: 11</td>-->
    <!--  <td colspan="4">Hours Fished: 8.00</td>-->
    <!--</tr>-->
    <!-- <tr>-->
    <!--  <td colspan="4">Teams Fished Weighed: 34</td>-->
    <!--  <td colspan="4">Average Weight / Fish: 4.42</td>-->
    <!--</tr>-->
    
  </tbody>
  
</table>
</div>
<div class="row">
    <div class="col-lg-6" style="font-weight:bold">
        <p class="text-center">Teams Fished: 11</p>
        <p class="text-center">Total Fish Weighed: 34</p>
        <p class="text-center">Total Fish Released: 34 100%</p>
        <p class="text-center">Total Fish Weight: 150.21</p>
    </div>
     <div class="col-lg-6" style="font-weight:bold">
        <p class="text-center">Hours Fished: 8.00</p>
        <p class="text-center">Average Weight / Fish: 4.42</p>
        <p class="text-center">Average #Fish / Team: 3.09</p>
        <p class="text-center">Average Weight / Team: 12.52</p>
    </div>
</div>
 
 
 
 
  </div>
</div>
<!--End First Table-->

<!--Start Second Table-->
            
              <div class="card mt-5">
  <div class="card-header" style="background-color:#091b85; color:#ffffff;">
    Northern Qualifer Day 2 Results
  </div>
  <div class="card-body">
    <!--<h5 class="card-title">Special title treatment</h5>-->
    <div class="table-responsive">
   <table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Place</th>
      <th scope="col">Team</th>
      <th scope="col">Fish</th>
      <th scope="col">Wgt</th>
       <th scope="col">Pnity</th>
      <th scope="col">B/F</th>
      <th scope="col">Total</th>
      <th scope="col">Points</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>MIKE TROMBLY-MARK MODRAK</td>
      <td>5/5</td>
      <td>26.93</td>
      <td></td>
      <td>5.99</td>
      <td>26.93</td>
    </tr>
    
     <tr>
      <th scope="row">2</th>
      <td>NATHAN TROYANEK-JEFF CROWLEY</td>
      <td>5/5</td>
      <td>26.23</td>
      <td></td>
      <td>6.80</td>
      <td>26.23</td>
    </tr>
    
      <tr>
      <th scope="row">3</th>
      <td>ELI JAIME-AVERY MARROW</td>
      <td>5/5</td>
      <td>23.68</td>
      <td></td>
      <td>4.28</td>
      <td>23.68</td>
    </tr>
    
    <tr>
      <th scope="row">4</th>
      <td>BEN NOWAK-NATHEN DERDOWSKI</td>
      <td>5/5</td>
      <td>22.61</td>
      <td></td>
      <td>6.69</td>
      <td>22.61</td>
    </tr>
     <tr>
      <th scope="row">5</th>
      <td>TREVOR JANCASZ-KEVIN VITA</td>
      <td>3/3</td>
      <td>11.71</td>
      <td></td>
      <td>4.62</td>
      <td>11.71</td>
    </tr>
    
     <tr>
      <th scope="row">6</th>
      <td>BILL HORTON-*KIM OSTRANDER</td>
      <td>3/3</td>
      <td>9.02</td>
      <td></td>
      <td></td>
      <td>9.02</td>
    </tr>
    
    <tr>
      <th scope="row">7</th>
      <td>ROBERT GROSSE-RICHARD GROSS</td>
      <td>3/3</td>
      <td>9.01</td>
      <td></td>
      <td>4.54</td>
      <td>9.01</td>
    </tr>
    
    <tr>
      <th scope="row">8</th>
      <td>DON BOBO-SEAN HUPP</td>
      <td>2/2</td>
      <td>6.72</td>
      <td></td>
      <td></td>
      <td>6.72</td>
    </tr>
    
     <tr>
      <th scope="row">9</th>
      <td>SHAYNE CLEVELAND-KENNETH CLEVELAND</td>
      <td></td>
      <td>.00</td>
      <td></td>
      <td></td>
      <td>.00</td>
    </tr>
    
    
     <tr>
      <th scope="row">9</th>
      <td>WILLIAM HUGHES-JOE HERRON</td>
      <td></td>
      <td>.00</td>
      <td></td>
      <td></td>
      <td>.00</td>
    </tr>
     <tr>
      <th scope="row">9</th>
      <td>CHASE SARIFIN-NICHOLAS CZAJAK</td>
      <td></td>
      <td>.00</td>
      <td></td>
      <td></td>
      <td>.00</td>
    </tr>
    
    
    <!-- <tr>-->
    <!--  <td colspan="4">Teams Fished: 11</td>-->
    <!--  <td colspan="4">Hours Fished: 8.00</td>-->
    <!--</tr>-->
    <!-- <tr>-->
    <!--  <td colspan="4">Teams Fished Weighed: 34</td>-->
    <!--  <td colspan="4">Average Weight / Fish: 4.42</td>-->
    <!--</tr>-->
    
  </tbody>
  
</table>
</div>
<div class="row">
    <div class="col-lg-6" style="font-weight:bold">
        <p class="text-center">Teams Fished: 11</p>
        <p class="text-center">Total Fish Weighed: 31</p>
        <p class="text-center">Total Fish Released: 31 100%</p>
        <p class="text-center">Total Fish Weight: 135.91</p>
    </div>
     <div class="col-lg-6" style="font-weight:bold">
        <p class="text-center">Hours Fished: 8.00</p>
        <p class="text-center">Average Weight / Fish: 4.38</p>
        <p class="text-center">Average #Fish / Team: 2.82</p>
        <p class="text-center">Average Weight / Team: 11.33</p>
    </div>
</div>
 
  </div>
</div>
<!--End Second Table-->

<!--Start Third Table-->
             <div class="card mt-5">
  <div class="card-header" style="background-color:#091b85; color:#ffffff;">
    Northern Qualifer Final Results
  </div>
  <div class="card-body">
    <!--<h5 class="card-title">Special title treatment</h5>-->
    <div class="table-responsive">
   <table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Place</th>
      <th scope="col">Team</th>
      <th scope="col">Fish</th>
      <th scope="col">Wgt</th>
       <th scope="col">Pnity</th>
      <th scope="col">B/F</th>
      <th scope="col">Total</th>
      <th scope="col">Points</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>MIKE TROMBLY-MARK MODRAK</td>
      <td>10/10</td>
      <td>51.44</td>
      <td></td>
      <td>5.99</td>
      <td>51.44</td>
    </tr>
    
     <tr>
      <th scope="row">2</th>
      <td>NATHAN TROYANEK-JEFF CROWLEY</td>
      <td>10/10</td>
      <td>51.37</td>
      <td></td>
      <td>6.80</td>
      <td>51.37</td>
    </tr>
    
      <tr>
      <th scope="row">3</th>
      <td>BEN NOWAK-NATHEN DERDOWSKI</td>
      <td>10/10</td>
      <td>43.99</td>
      <td></td>
      <td>6.69</td>
      <td>43.99</td>
    </tr>
    
    <tr>
      <th scope="row">4</th>
      <td>ELI JAIME-AVERY MARROW</td>
      <td>10/10</td>
      <td>37.96</td>
      <td></td>
      <td>5.09</td>
      <td>37.96</td>
    </tr>
     <tr>
      <th scope="row">5</th>
      <td>TREVOR JANCASZ-KEVIN VITA</td>
      <td>8/8</td>
      <td>36.10</td>
      <td></td>
      <td>5.88</td>
      <td>36.10</td>
    </tr>
    
     <tr>
      <th scope="row">6</th>
      <td>BILL HORTON-*KIM OSTRANDER</td>
      <td>8/8</td>
      <td>30.36</td>
      <td></td>
      <td>5.99</td>
      <td>30.36</td>
    </tr>
    
    <tr>
      <th scope="row">7</th>
      <td>DON BOBO-SEAN HUPP</td>
      <td>5/5</td>
      <td>21.64</td>
      <td></td>
      <td>6.66</td>
      <td>21.64</td>
    </tr>
    
    <tr>
      <th scope="row">8</th>
      <td>ROBERT GROSSE-RICHARD GROSS</td>
      <td>3/3</td>
      <td>9.01</td>
      <td></td>
      <td>4.54</td>
      <td>9.01</td>
    </tr>
    
     <tr>
      <th scope="row">9</th>
      <td>SHAYNE CLEVELAND-KENNETH CLEVELAND</td>
      <td>1/1</td>
      <td></td>
      <td>4.25</td>
      <td>4.25</td>
      <td>4.25</td>
    </tr>
    
    
     <tr>
      <th scope="row">10</th>
      <td>WILLIAM HUGHES-JOE HERRON</td>
      <td></td>
      <td>.00</td>
      <td></td>
      <td></td>
      <td>.00</td>
    </tr>
     <tr>
      <th scope="row">10</th>
      <td>CHASE SARIFIN-NICHOLAS CZAJAK</td>
      <td></td>
      <td>.00</td>
      <td></td>
      <td></td>
      <td>.00</td>
    </tr>
    
    
  
    
  </tbody>
  
</table>
</div>
<div class="row">
    <div class="col-lg-6" style="font-weight:bold">
        <p class="text-center">Teams Fished: 11</p>
        <p class="text-center">Total Fish Weighed: 65</p>
        <p class="text-center">Total Fish Released: 65 100%</p>
        <p class="text-center">Total Fish Weight: 286.12</p>
    </div>
     <div class="col-lg-6" style="font-weight:bold">
        <p class="text-center">Hours Fished: 8.00</p>
        <p class="text-center">Average Weight / Fish: 4.40</p>
        <p class="text-center">Average #Fish / Team: 5.91</p>
        <p class="text-center">Average Weight / Team: 23.84</p>
    </div>
</div>
 
  </div>
</div>            
              
              
              
              
              
              
              
              
              
              
              
              <!--End Third Table-->
              
              
              <!--Start Test-->
              <div class="text-center mt-5">





              </div>

              
              
              
              
              <!--End Test-->
              

            </div>
        </div>
    </div>
</section>
@stop