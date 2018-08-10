@extends('users.layouts.app')

@section('title', 'Shop')

@section('content')
<div style="position: relative; width: 100%; height: 100%;">
    <img class="img-fluid" src="{{ asset('storage/contact-us-banner-300.jpg') }}">
    <div class="shop-header-cover">
        <h1 class="shop-header-cover-title">About Us</h1>
    </div>
</div>
<div class="d-flex align-content-center justify-content-center text-center">
    @if (Request::is('v2') || Request::is('v2/shop'))
        @include('users.layouts.navbar-v2')
    @else
        @include('users.layouts.navbar')
    @endif
</div>

<div class="container mb-5 mt-4 pt-5">
    <div class="row">
        <h2 class="text-color-theme">About ANP</h2><br><br><br>
        <p>
            The Association of Negros Producers Inc., (ANP) was born during an ironically "sweet" crisis,
        a historical landmark of great distress in the country. The fateful fall of the sugar industry in the
        1980’s sparked the resilience and innovation our fore-founders in order to work towards overcoming the
        tragic fate the mono crop industry has brought Negros.
        </p>
        <p>
            A group of fifteen (15) Negrense women began what was then known as the House of Negros Foundation.
        Based in Manila, this paved the way of the birth of a non-stock, non-profit and non-political organization
        composed of professionals and entrepreneurs who had roots to Negros.  The foundation contributed extensively
        in alleviating the plight of more than 150,000 displaced workers from the sugar crisis. The association's
        members began working with these local farmers providing them with alternative income opportunities through
        budding and flourishing industries. The singular determination to create just one more job brought this stalwart
        association to where it is now, an established beacon of hope.
        </p>
        <p>
            To date, the Association of Negros Producers Inc., (ANP) with the aid of our partners continues to support
        our local micro-small to medium enterprises and the communities that they work with, by providing them with
        various platforms where they can advertise, sell their products and expand their market.
        <br><br>
        </p>

        <p><h4 class="text-color-secondary">OBJECTIVES:</h4><br>

        · Represent, promote and lobby the interest of micro-small to medium scale producers in Negros<br>
        · Encourage cooperation among our producers and key players in various industries in the community<br>
        · Promote the best of Negros products' and our local artisans
        · Promote the culture of productivity and technological upgrading of the manufacturing sector in Negros
        </p>
        <h4 class="text-color-secondary">VISION:</h4>
        <br><br>
        <p>Association of Negros Producers (ANP) is an organization:
        <br>
        Micro-Small and Medium Enterprises who uphold the quality and pursuit of excellence as a way of life
        <br>
        That fosters entrepreneurial development where every member is an exporter of globally-competitive products
        <br>
        Where every member is dedicated to harness indigenous skills and resources to create alternative industries to replace an economy that is largely dependent on a monocrop industry
        <br>
        Where every member is conscious of his/her responsibilities to society and the environment
        <br>
        Where every member recognize the importance of sharing each other’s resources<br><br></p>

        <h4 class="text-color-secondary">MISSION:</h4><br><br>
        <p>
            We, the member of the Association of Negros Producers (ANP), pioneers in the field of entrepreurship
        development, dedicate ourselves to the dynamic development of SME manufacturers through trainings, trade
        promotion and linkage with government and non-government agencies
        </p>
        <p>
            Believing in our individual and collection capabilities, we commit to harness our resources to be the
        catalyst of entrepreneurship growth and social development by strengthening our membership base.
        </p>

        We will continuously contribute to the development of a nation that comes from the empowerment of a nation that comes from the empowerment of its people through entrepreneurship.

        We pledge to continuously direct our mission by providing the strong foundation and framework for sustainable growth for the benefits of the future generation and for the improvement of the quality of life of every Filipino.
    </div>
</div>

@endsection
