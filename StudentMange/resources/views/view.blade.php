@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="text-center">Total Student:{{$all_count}}</h1>
            <div class="row g-4">
                @foreach ($all_infos as $all_info)
                <div class="col-lg-4 col-md-6 wow fadeInUp mb-5" data-wow-delay="0.1s">
                    <a class="service-item d-block rounded text-center h-100 " href="">
                        <img class="img-fluid rounded mb-2" src="{{ 'student_image' }}/{{ $all_info->image }}" width="150" height="150" alt="">
                        <h4 class="mb-0">{{$all_info->name}}</h4>
                    </a>
                    <div class="text-center">
                        <a href="{{route('this_person_info',$all_info->id)}}" class="btn btn-success">Detials</a>
                        <a href="{{route('edit_blade',$all_info->id)}}" class="btn btn-primary">Edit</a>
                        <a href="{{route('delete_blade',$all_info->id)}}" class="btn btn-danger">Delete</a>
                    </div>
                   
                </div>
              @endforeach
            </div>
        </div>
    </div>
@endsection
