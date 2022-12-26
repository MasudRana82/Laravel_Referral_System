<h1>Register</h1>

<form action="{{ route('registered') }} " method="post">
@csrf
<input type="text" name="name" placeholder="Enter Name">
@error('name')
<span style="color: red">{{$message}} </span>
    
@enderror
<br><br>

<input type="email" name="email" placeholder="Enter email">
@error('email')
<span style="color: red">{{$message}} </span>
    
@enderror
<br><br>
@if (!isset($_GET['ref']))
   <input type="text" name="referral_code" placeholder="Enter referral_code"  > 
@else
<input type="text" name="referral_code" style="pointer-events:none; background-color:lightgray" placeholder="Enter referral_code" value="<?=
     $_GET['ref']; ?> ">
@endif
<br><br>
<input type="password" name="password" placeholder="Enter password">
@error('password')
<span style="color: red">{{$message}} </span>
    
@enderror
<br><br>

<input type="password" name="password_confirmation" placeholder="Enter password password_confirmation">
@error('password')
<span style="color: red">{{$message}} </span>
    
@enderror
<br><br>
<input type="submit" value="register">

</form>
@if(Session::has('success'))
<p style="colro:green"> {{Session::get('success')}}</p> 
@endif
@if(Session::has('error'))
<p style="colro:red"> {{Session::get('error')}}</p>
@endif

