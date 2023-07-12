<?php   
use Illuminate\Support\Facades\Auth;
?>
<h1>Hello World! </h1>
<br><?php echo auth()->user()->name." ( ".auth()->user()->alias.' )';   ?>
<p>Welcome to the GradeX sourcode grading system 
</p>