@extends('submission.mainlayout')
@section('rightpanel')
<div class="jumbotron">
    <h1 class="display-4">CSMJU Programming Grader</h1>
    <p class="lead">Version 2.0</p>
    <hr class="my-4">
    <p>This software is developed by Miss Kanyarat	Kerdphon and Miss Boonyanuch Sukala as a senoir project,
        under supervision of Asst. Prof. Kongkarn Dullayachai and Dr. Part Pramokchon and Dr. Paween Khoenkaw<br/>
    The codebase is maintained by Dr.Paween Khoenkaw, please report bugs and problems directly to email:paween_k@gmaejo.mju.ac.th
    </p>
    <p>
        Hello
    </p>
</div>
<?php print_r($payload); ?>
@endsection