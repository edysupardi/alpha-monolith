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

        <div class="col-lg-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">@lang('title.branch') <a href="javascript:void(0);" id="addNew" class="btn btn-sm btn-success ms-2" data-bs-toggle="tooltip" title="@lang('button.add_new')"><i class="fas fa-plus"></i></a></h4>
            </div>
            <div class="row" id="branch-box">
                <div class="col-lg-4 branch-loading-box">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title placeholder-glow">
                                <span class="placeholder col-6"></span>
                                <span class="placeholder col-2 badge bg-primary">&nbsp;</span>
                            </h5>
                            <p class="card-text placeholder-glow">
                                <span class="placeholder col-12"></span>
                                <span class="placeholder col-4"></span>
                            </p>
                            <div class="card-footer p-0 bg-transparent row">
                                <div class="col-md-6 placeholder-glow">
                                    <a href="#" tabindex="-1" class="btn btn-sm btn-success disabled placeholder col-5"></a>
                                </div>
                                <div class="col-md-6 placeholder-glow">
                                    <a href="#" tabindex="-1" class="btn btn-sm btn-danger disabled placeholder col-5 float-end"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="branchModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="branch-form" data-state="new" class="needs-validation" novalidate>
                    <input type="hidden" name="id" id="branch-ref"/>
                    <div class="modal-header">
                        <h5 class="modal-title" id="branchModalHeader"></h5>
                        <button type="button" class="btn-close btn-loading" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 form-group required">
                            <label class="control-label form-label" for="field-name-branch">@lang('field.branch')</label>
                            <input type="text" class="form-control" id="field-name-branch" name="name" placeholder="@lang('field.enter_branch')" required/>
                            <div id="field-branchFeedback" class="invalid-feedback">@lang('field.invalid_branch')</div>
                        </div>
                        <div class="mb-3 form-group required">
                            <label class="control-label form-label" for="field-phone_number-branch">@lang('field.phone_number')</label>
                            <input type="text" class="form-control" id="field-phone_number-branch" name="phone_number" placeholder="@lang('field.enter_phone_number')" required/>
                            <div id="field-phone_number-branchFeedback" class="invalid-feedback">@lang('field.invalid_phone_number')</div>
                        </div>
                        <div class="mb-3 form-group required">
                            <label class="control-label form-label" for="field-provience-branch">@lang('field.provience')</label>
                            <select class="form-control" data-ref="" id="field-provience-branch" name="provience" placeholder="@lang('field.enter_provience')" required></select>
                            <div id="field-provience-branchFeedback" class="invalid-feedback">@lang('field.invalid_provience')</div>
                        </div>
                        <div class="mb-3 form-group required">
                            <label class="control-label form-label" for="field-district-branch">@lang('field.district')</label>
                            <select class="form-control" data-ref="" id="field-district-branch" name="district" placeholder="@lang('field.enter_district')" required></select>
                            <div id="field-district-branchFeedback" class="invalid-feedback">@lang('field.invalid_district')</div>
                        </div>
                        <div class="mb-3 form-group required">
                            <label class="control-label form-label" for="field-subdistrict-branch">@lang('field.subdistrict')</label>
                            <select class="form-control" data-ref="" id="field-subdistrict-branch" name="subdistrict" placeholder="@lang('field.enter_subdistrict')" required></select>
                            <div id="field-subdistrict-branchFeedback" class="invalid-feedback">@lang('field.invalid_subdistrict')</div>
                        </div>
                        <div class="mb-3 form-group required">
                            <label class="control-label form-label" for="field-village-branch">@lang('field.village')</label>
                            <select class="form-control" data-ref="" id="field-village-branch" name="village" placeholder="@lang('field.enter_village')" required></select>
                            <div id="field-village-branchFeedback" class="invalid-feedback">@lang('field.invalid_village')</div>
                        </div>
                        <div class="mb-3 form-group required">
                            <label class="control-label form-label" for="field-zip_code-branch">@lang('field.zip_code')</label>
                            <input type="number" maxlength="5" class="form-control" id="field-zip_code-branch" name="zip_code" placeholder="@lang('field.enter_zip_code')" required/>
                            <div id="field-zip_code-branchFeedback" class="invalid-feedback">@lang('field.invalid_zip_code')</div>
                        </div>
                        <div class="mb-3 form-group required">
                            <label class="control-label form-label" for="field-address-branch">@lang('field.address')</label>
                            <textarea class="form-control h-25" id="field-address-branch" name="address" placeholder="@lang('field.enter_address')" required></textarea>
                            <div id="field-address-branchFeedback" class="invalid-feedback">@lang('field.invalid_address')</div>
                        </div>
                        <div class="mb-3 form-group required">
                            <label class="control-label form-label" for="field-is_main-branch">@lang('field.main_branch')</label>
                            <div>
                                <input type="checkbox" id="field-is_main-branch" name="is_main" switch="bool"/>
                                <label for="field-is_main-branch" data-on-label="@lang('field.yes')" data-off-label="@lang('field.no')"></label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-loading btn-primary waves-effect waves-light">Save</button>
                    </div>
                </form>
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
        }, branchUrl = {
            my: "{{ route('branch.list') }}",
            store: "{{ route('branch.store') }}",
            update: "{{ route('branch.update', ':id') }}",
            detail: "{{ route('branch.detail', '') }}",
            delete: "{{ route('branch.delete', ':id') }}",
        }, translate = {
            branch: "@lang('title.branch')"
        }
    </script>

    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/company/1923y97.js') }}"></script>
@endsection
