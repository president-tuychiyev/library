    <!-- begin::user info modals -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="modal-title form-label" id="infoModalLabel">@lang('locale.modal.user-info.title')</label>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center row">
                        <div class="col-sm-5">
                            <div class="card-body">
                                <img class="rounded" src="/" id="avatar-info-modal" height="140">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h2 class="card-title font-bold mb-1" id="user-name-info-modal"></h2>
                                <p class="mb-1"><span class="font-bold">@lang('locale.modal.user-info.gr')</span> <span
                                        id="group-info-modal"></span></p>
                                <p class="mb-1"><span class="font-bold">@lang('locale.modal.user-info.email')</span> <span
                                        id="email-info-modal"></span></p>
                                <p class="mb-1"><span class="font-bold">@lang('locale.modal.user-info.phone')</span> <span
                                        id="phone-info-modal"></span></p>
                                <span class="badge bg-label-primary">@lang('locale.modal.user-info.read-book') <span
                                        id="books-info-modal"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger bg-red-600" data-bs-dismiss="modal">@lang('locale.app.button.back')</button>
                    <button type="button" class="btn btn-primary bg-blue-700"
                        onclick="printDocument()">@lang('locale.app.button.document')</button>
                </div>
            </div>
        </div>
    </div>

    <!-- begin::user settings -->
    <div class="modal fade" id="profilSettingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="profilSettingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.users.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="number" name="id" id="profile-id" hidden>
                    <div class="modal-header">
                        <label class="modal-title form-label" id="titleProfile"></label>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 fv-plugins-icon-container">
                            <div class="input-group input-group-merge mb-2">
                                <input type="text" class="form-control" name="name" id="profile-name"
                                    placeholder="F.I.O" required data-bs-toggle="tooltip"
                                    data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                    title="@lang('locale.app.tooltip.required')">
                            </div>
                            <div class="input-group input-group-merge mb-2">
                                <span class="input-group-text select-none">+998</span>
                                <input type="number" maxlength="9" class="form-control" name="phone"
                                    id="profile-phone" placeholder="9* *** ** **" required data-bs-toggle="tooltip"
                                    data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                    title="@lang('locale.app.tooltip.required')">
                            </div>
                            <div class="input-group input-group-merge mb-2">
                                <input type="email" maxlength="30" class="form-control" name="email"
                                    id="profile-email" placeholder="Pochta manzili" required data-bs-toggle="tooltip"
                                    data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                    title="@lang('locale.app.tooltip.required')">
                            </div>
                            <div class="mb-2 form-password-toggle fv-plugins-icon-container">
                                <div class="input-group input-group-merge">
                                    <input class="form-control" type="password" name="pass"
                                        placeholder="············" data-bs-toggle="tooltip"
                                        data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                        title="@lang('locale.app.tooltip.no-required')">
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="input-group input-group-merge mb-3">
                                <input class="form-control" name="avatar" type="file" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Foydalanuvchi rasmini tanlang | *@lang('locale.app.tooltip.no-required')"
                                    accept=".jpg,.jpeg,.png">
                                <span class="input-group-text text-red-300 select-none">*jpg,
                                    *png</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger bg-red-600" data-bs-dismiss="modal">@lang('locale.app.button.cancel')</button>
                        <button type="submit" class="btn btn-primary bg-blue-800">@lang('locale.app.button.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end::user settings -->

    <!-- begin::print user document -->
    <div class="col-md-6 col-lg-4 mb-4 order-lg-1 order-2 max-w-xs3" id="printDiv" hidden>
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-8">
                    <div class="card-body">
                        <h6 class="card-title mb-1 text-nowrap font-bold" id="user-name-doc"></h6>
                        <h5 class="card-title text-primary mb-1" id="email-doc"></h5>
                        <h5 class="card-title text-primary mb-1" id="phone-doc"></h5>
                    </div>
                </div>
                <div class="col-4">
                    <div id="qr-code" class="inline-block relative bottom-5"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end::print user document -->


    <!-- begin::confirm model -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content items-center justify-center">
                <div class="modal-body">
                    <strong>@lang('locale.modal.delete.title')</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger bg-red-600" data-bs-dismiss="modal">@lang('locale.app.button.back')</button>
                    <a id="deleteBookBtn" class="btn btn-primary bg-blue-500">@lang('locale.app.button.delete')</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end::confirm model -->

    @if (session()->has('msg') or $errors->any())
        <!-- begin::messages -->
        <audio id="error-audio" src="{{ asset('img/alert.mp3') }}" preload="auto"></audio>
        <script>
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                @if ($errors->any())
                    title: "{!! implode('', $errors->all(':message')) !!}",
                    icon: "error",
                @else
                    title: "{{ session()->get('msg')['title'] }}",
                    icon: "{{ session()->get('msg')['icon'] }}"
                @endif
            })

            @if (session()->get('msg')['icon'] == 'error')
                document.getElementById('error-audio').play();
            @endif
        </script>
        <!-- end::messages -->
    @endif
