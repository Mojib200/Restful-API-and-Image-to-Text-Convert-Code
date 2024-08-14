@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-md-12">
                <h1 class="text-center">Student Information Edit</h1>
                <div>
                    <div class="card">
                        <div class="card-body text-center">
                            <form action="{{route('edit_information')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-4 text-center">

                                    <div class="mb-3">
                                        <label for="">Name</label>
                                        <input type="text" placeholder="Name" name="name" value="{{$info_this_edit->name}}">
                                        <input type="hidden" placeholder="" name="auth_name" value="{{Auth::user()->name }}">
                                        <input type="hidden" placeholder="" name="id" value="{{$info_this_edit->id }}">
                                        <label for="">Father Name</label>
                                        <input type="text" placeholder="Father Name" name="f_name" value="{{$info_this_edit->f_name}}">
                                        <label for="">Mother Name</label>
                                        <input type="text" placeholder="Mother Name" name="m_name" value="{{$info_this_edit->m_name}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Contact</label>
                                        <input type="number" placeholder="Contact" name="contact" value="{{$info_this_edit->contact}}">
                                        <label for="">Email</label>
                                        <input type="email" placeholder="Email" name="email" value="{{$info_this_edit->email}}">
                                        <label for="">Subject</label>
                                        <input type="text" placeholder="Subject" name="subject" value="{{$info_this_edit->subject}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Tuition Fee</label>
                                        <input type="number" placeholder="Tuition Fee" name="tuition_fee" value="{{$info_this_edit->tuition_fee}}">
                                        <label for="">Address</label>
                                        <input type="text" placeholder="Address" name="address" value="{{$info_this_edit->address}}">
                                        <label for="">Image</label>
                                        <input type="file" placeholder="Image" name="image">
                                        <label for="">{{$info_this_edit->image}}</label>
                                    </div>
                                </div>
                                <div class="text-ceter">
                                    <button class="btn btn-primary ">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
