   <section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Store</h2>
        <p>Check our Store</p>
      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".1">Near Me</li>
            <li data-filter=".Dine_in">Dine in</li>
            <li data-filter=".Take_out">Take out</li>
            <li data-filter=".Dine_in_Take_out">Dine in and Take out</li>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

        @foreach ($restaurants as $restaurant)
          <div class="col-lg-4 col-md-6 portfolio-item {{$restaurant->type}} {{$restaurant->city_id}}">
            <div class="portfolio-wrap">
              <img src="{{ asset('images/logo/' . $restaurant->image)}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>{{$restaurant->store_name}}</h4>
                <p>{{$restaurant->address}}</p>
                <div class="portfolio-links">
                  <a href="{{ asset('images/logo/' . $restaurant->image)}}" data-gall="portfolioGallery" class="venobox" title="App 1"><i class="bx bx-plus"></i></a>
                  <a href="{{ url('shop/order/' . $restaurant->id) }}" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </section>