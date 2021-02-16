@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h1>Create New Corective Maintenance Report</h1>
            <div class="row">
                <div class="col-md-12">
                    {{-- List of Form Name Inputs:
                        head_id
                        remark --}}
                    <form method="post" action="/report/cm" class="form-horizontal">
                        @csrf

                        {{-- HIDDEN --}}
                        <input type="hidden" name="head_id" value="{{ $headId }}">
                        {{-- END OF HIDDEN --}}

                        {{-- CKEDITOR REMARK --}}
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('REMARK') }}</h4>
                            </div>

                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <textarea class="editor" name="remark" id="editor" cols="50" rows="10"
                                                class="form-control"
                                                placeholder="@error('remark') {{ $message }} @enderror">
                                                {{ old('remark') }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END OF CKEDITOR REMARK --}}

                        {{-- BUTTON GROUP --}}
                        <div class="d-flex justify-content-end">
                            <a type="button" class="btn btn-info" href="{{ url('expert') }}">BACK</a>
                            <button type="submit" value='submit' class="btn btn-primary mx-5">SUBMIT</button>
                        </div>
                        {{-- END OF BUTTON GROUP --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    window.onload = function() {
        /*
         *   FUNGSI MEMANGGIL CKEDITOR
         */
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    };

</script>
