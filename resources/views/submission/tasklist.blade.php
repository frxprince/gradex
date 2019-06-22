


<div id="accordion">

@foreach (session('courses') as $item)
<br>

    <div class="card">
      <div class="card-header" id="heading{{$item['title']}}">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$item['title']}}" aria-expanded="true" aria-controls="collapse{{$item['title']}}">
            Course: {{$item['title']}}
          </button>
        </h5>
      </div>
  
      <div id="collapse{{$item['title']}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
          <?php
            
            
            
            ?>
        </div>
      </div>
    </div>


@endforeach    
  </div>




