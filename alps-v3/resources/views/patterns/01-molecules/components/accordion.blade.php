@php($accordion = get_field('accordion'))
@if ($accordion)
  <div class="accordion spacing">
    <h3>{{ the_field('accordion_title') }}</h3>
    <div class="accordion--inner background-color--white">
      @foreach ($accordion as $item)
        <div class="accordion-item cf">
          <div class="accordion-item__header js-toggle-parent color--secondary">
            <span class="accordion-item__toggle"></span>
            <h5 class="font--l">{{ $item['accordion_heading'] }}</a>
          </div>
          <div class="accordion-item__body article__body spacing">
            @php echo wpautop($item['accordion_body']); @endphp
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endif
