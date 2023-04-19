@extends('layouts.master')

@section('title') @lang('title.company') @endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang('menu.dashboard') @endslot
        @slot('title') @lang('menu.company') @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form id="company-form" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 ajax-select mt-3 mt-lg-0 form-group required">
                                    <label class="control-label form-label" for="field-name">@lang('field.company')</label>
                                    <input type="text" class="form-control" id="field-name" name="name" placeholder="@lang('field.enter_company')" required/>
                                    <div id="field-nameFeedback" class="invalid-feedback">@lang('field.invalid_company')</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 ajax-select mt-3 mt-lg-0 form-group required">
                                    <label class="control-label form-label" for="field-phone_number">@lang('field.phone_number')</label>
                                    <input type="tel" maxlength="20" class="form-control" id="field-phone_number" name="phone_number" placeholder="@lang('field.enter_phone_number')" required/>
                                    <div id="field-phone_numberFeedback" class="invalid-feedback">@lang('field.invalid_phone_number_number')</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 ajax-select mt-3 mt-lg-0 form-group required">
                                    <label class="control-label form-label" for="field-provience">@lang('field.provience')</label>
                                    <select class="form-control" data-ref="" id="field-provience" name="provience" placeholder="@lang('field.enter_provience')" required></select>
                                    <div id="field-provienceFeedback" class="invalid-feedback">@lang('field.invalid_provience')</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 ajax-select mt-3 mt-lg-0 form-group required">
                                    <label class="control-label form-label" for="field-district">@lang('field.district')</label>
                                    <select class="form-control" data-ref="" id="field-district" name="district" placeholder="@lang('field.enter_district')" required></select>
                                    <div id="field-districtFeedback" class="invalid-feedback">@lang('field.invalid_district')</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 ajax-select mt-3 mt-lg-0 form-group required">
                                    <label class="control-label form-label" for="field-subdistrict">@lang('field.subdistrict')</label>
                                    <select class="form-control" data-ref="" id="field-subdistrict" name="subdistrict" placeholder="@lang('field.enter_subdistrict')" required></select>
                                    <div id="field-subdistrictFeedback" class="invalid-feedback">@lang('field.invalid_subdistrict')</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 ajax-select mt-3 mt-lg-0 form-group required">
                                    <label class="control-label form-label" for="field-village">@lang('field.village')</label>
                                    <select class="form-control" data-ref="" id="field-village" name="village" placeholder="@lang('field.enter_village')" required></select>
                                    <div id="field-villageFeedback" class="invalid-feedback">@lang('field.invalid_village')</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 ajax-select mt-3 mt-lg-0 form-group required">
                                    <label class="control-label form-label" for="field-zip_code">@lang('field.zip_code')</label>
                                    <input type="number" maxlength="5" class="form-control" id="field-zip_code" name="zip_code" placeholder="@lang('field.enter_zip_code')" required/>
                                    <div id="field-zip_codeFeedback" class="invalid-feedback">@lang('field.invalid_zip_code')</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3 ajax-select mt-3 mt-lg-0 form-group required">
                                    <label class="control-label form-label" for="field-address">@lang('field.address')</label>
                                    <textarea class="form-control h-25" id="field-address" name="address" placeholder="@lang('field.enter_address')" required></textarea>
                                    <div id="field-addressFeedback" class="invalid-feedback">@lang('field.invalid_address')</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary w-md btn-loading">@lang('button.submit') <span class="loading-btn d-none"><i class="fas fa-spinner fa-spin"></i></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var companyUrl = {
            my: "{{ route('company.my.get') }}",
            update: "{{ route('company.update.mine') }}",
        }, territoryUrl = {
            provience: "{{ route('territory.provience.all') }}",
            district: "{{ route('territory.district.all') }}?provience=",
            subdistrict: "{{ route('territory.subdistrict.all') }}?district=",
            village: "{{ route('territory.village.all') }}?subdistrict=",
        };
    </script>

    <script src="{{ URL::asset('/assets/js/company/1923y97.js') }}"></script>
@endsection
