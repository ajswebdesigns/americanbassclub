@extends('layouts.site-layout')

@section('content')

<section class="border-bottom" id="about">
    <div class="container px-5 my-5">
        <div class="row gx-4 gx-lg-5">
            <div class="col-md-12">
                <h1 class="mt-5">About Us</h1>
                    {!!
                        DB::table('page_manager')
                            ->where('page_slug', 'about')->first()->page_details;
                    !!}

            </div>
        </div>
    </div>
</section>
@stop