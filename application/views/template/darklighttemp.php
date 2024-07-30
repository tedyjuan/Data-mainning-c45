<!--begin:: menu dark dan light-->
<div id="kt_app_layout_builder" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="app-settings" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'lg': '380px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_layout_builder_toggle" data-kt-drawer-close="#kt_app_layout_builder_close">
    <div class="card border-0 shadow-none rounded-0 w-100">
        <div class="card-header bgi-position-y-bottom bgi-position-x-end bgi-size-cover bgi-no-repeat rounded-0 border-0 py-4" id="kt_app_layout_builder_header" style="background-image:url('<?= base_url(); ?>demo38/assets/media/misc/layout/customizer-header-bg.jpg')">
            <h3 class="card-title fs-3 fw-bold text-white flex-column m-0">
                Theme Builder

                <small class="text-white opacity-50 fs-7 fw-semibold pt-1">
                    Get your product deeply customized
                </small>
            </h3>
            <!--end::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-icon btn-color-white p-0 w-20px h-20px rounded-1" id="kt_app_layout_builder_close">
                    <i class="ki-outline ki-cross-square fs-2"></i> </button>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body position-relative" id="kt_app_layout_builder_body">
            <!--begin::Content-->
            <div id="kt_app_settings_content" class="position-relative scroll-y me-n5 pe-5" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_app_layout_builder_body" data-kt-scroll-dependencies="#kt_app_layout_builder_header, #kt_app_layout_builder_footer" data-kt-scroll-offset="5px">
                <!--begin::Form-->
                <form class="form" method="POST" id="kt_app_layout_builder_form" action="<?= base_url(); ?>demo38/index.php">
                    <input type="hidden" id="kt_app_layout_builder_action" name="layout-builder[action]" />
                    <!--begin::Card body-->
                    <div class="card-body p-0">
                        <!--begin::Form group-->
                        <div class="form-group">
                            <div class="mb-6">
                                <h4 class="fw-bold text-dark">Theme Mode</h4>
                                <div class="fw-semibold text-muted fs-7 d-block lh-1">
                                    Enjoy Dark & Light modes.
                                </div>
                            </div>
                            <div class="row " data-kt-buttons="true" data-kt-buttons-target=".form-check-image,.form-check-input">
                                <div class="col-6">
                                    <label class="form-check-image form-check-success">
                                        <div class="form-check-wrapper border-gray-200 border-2">
                                            <img src="<?= base_url(); ?>demo38/assets/media/preview/demos/demo38/light-ltr.png" class="form-check-rounded mw-100" alt="" />
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid form-check-sm form-check-success">
                                            <input class="form-check-input" type="radio" value="light" name="theme_mode" id="kt_layout_builder_theme_mode_light" />
                                            <div class="form-check-label text-gray-700">Light </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <label class="form-check-image form-check-success">
                                        <div class="form-check-wrapper border-gray-200 border-2">
                                            <img src="<?= base_url(); ?>demo38/assets/media/preview/demos/demo38/dark-ltr.png" class="form-check-rounded mw-100" alt="" />
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid form-check-sm form-check-success">
                                            <input class="form-check-input" type="radio" value="dark" name="theme_mode" id="kt_layout_builder_theme_mode_dark" />
                                            <div class="form-check-label text-gray-700">Dark </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
<!--end::App layout builder-->

<!--begin::App settings toggle-->
<button id="kt_app_layout_builder_toggle" class="btn btn-sm btn-dark opacity-20 app-layout-builder-toggle lh-1 py-4 " data-bs-custom-class="tooltip-inverse" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-dismiss="click" data-bs-trigger="hover">
    <i class="ki-outline ki-setting-4 fs-4 me-1"></i>
</button>
<!--end:: menu dark dan light-->