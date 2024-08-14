@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-md-12">
                <h1 class="text-center">Student Information Insert</h1>
                <div>
                    <div class="card">
                        <div class="card-body text-center">
                            <form action="{{route('insert_information')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-4 text-center">

                                    <div class="mb-3">
                                        <label for="">Name</label>
                                        <input type="text" placeholder="Name" name="name">
                                        <input type="hidden" placeholder="" name="auth_name" value="{{Auth::user()->name }}">
                                        <label for="">Father Name</label>
                                        <input type="text" placeholder="Father Name" name="f_name">
                                        <label for="">Mother Name</label>
                                        <input type="text" placeholder="Mother Name" name="m_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Contact</label>
                                        <input type="number" placeholder="Contact" name="contact">
                                        <label for="">Email</label>
                                        <input type="email" placeholder="Email" name="email">
                                        <label for="">Subject</label>
                                        <input type="text" placeholder="Subject" name="subject">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Tuition Fee</label>
                                        <input type="number" placeholder="Tuition Fee" name="tuition_fee">
                                        <label for="">Address</label>
                                        <input type="text" placeholder="Address" name="address">
                                        <label for="">Image</label>
                                        <input type="file" placeholder="Image" name="image">
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
