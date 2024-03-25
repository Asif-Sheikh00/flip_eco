<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Create User</h6>
                <form wire:submit.prevent="store()" >
                    <div class="row mb-3">
                        <label for="user_name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10 position-relative">
                            <input type="text" wire:model="user_name" autocomplete="off" placeholder="Enter user name ✌ <i>hello</i>" class="form-control" id="user_name">
                            @error('user_name') <span class="text-danger position-absolute" style="top:8px; right:35px;"><i class="fa fa-info-circle" title="{{ $message }}"></i></span> @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" wire:model="user_email" autocomplete="off" placeholder="Enter user email" class="form-control" id="inputEmail3">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" wire:model="user_password" autocomplete="off" placeholder="Enter user password" class="form-control" id="inputPassword3">
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" wire:model="user_status" type="radio" name="inlineRadioOptions" checked="checked" id="active" value="active">
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" wire:model="user_status" type="radio" name="inlineRadioOptions" id="inactive" value="inactive">
                                <label class="form-check-label" for="inactive">Inactive</label>
                            </div>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>