<script>
    slidesVariables.push({
        id: "{{$id}}",
        img: "{{ $img }}",
        img_stretch: "{{$img_stretch}}"
    });
</script>

<div class="col-12 col-md-12 col-xxl-11 shadow mb-xxl-5 mb-3 slide-container" id="{{ $id }}"
     style="background-image: url('{{ $img }}')"
>
    <img class="slide-img" style="
         @if($img_stretch == 'horizontal') {{ 'width:101%; height:auto;' }}
         @elseif($img_stretch == 'vertical') {{ 'width:auto; height:101%;' }} @endif"
         src="{{ $img }}"
         alt="">
    <div class="slide-img-background"></div>
    <div class="slide-content-container">
        {!! $content !!}
    </div>
</div>
