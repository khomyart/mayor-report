<script>
    slidesVariables.push({
        id: "{{$id}}",
        img: "{{ $img }}",
        img_stretch: "{{$img_stretch}}"
    });
</script>

<div class="col-12 col-md-10 shadow mb-5 slide-container" id="{{ $id }}"
     style="background-image: url('{{ $img }}')"
>
    <img class="slide-img" style="
         @if($img_stretch == 'horizontal') {{ 'width:100%; height:auto;' }}
         @elseif($img_stretch == 'vertical') {{ 'width:auto; height:100%;' }} @endif"
         src="{{ $img }}"
         alt="">
    <div class="slide-img-background"></div>
    <div class="slide-content-container">
        {!! $content !!}
    </div>
</div>
