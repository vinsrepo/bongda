<input type="hidden" name="brandModel_id" value="{{ isset($brandModel) ? $brandModel->id : 0 }}">
<div class="row">
    <div class="col-md-6">
        <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">Tên nhãn hiệu hoặc Model <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="Tên nhãn hiệu hoặc model" name="name" value="{{ $brandModel->name ?? old('name')}}">
            <span class="help-block">{{ $errors->first('name') }}</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">
                <option value="{{ \App\Constants\TaxonomySetting::ACTIVE }}" {{ (@$brandModel->status == \App\Constants\TaxonomySetting::ACTIVE) ? 'selected="true"' : null }}>
                    Hoạt động
                </option>
                <option value="{{ \App\Constants\TaxonomySetting::INACTIVE }}" {{ (@$brandModel->status == \App\Constants\TaxonomySetting::INACTIVE) ? 'selected="true"' : null }}>
                    Không hoạt động
                </option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="model">Kiểu</label>
            <select class="form-control" name="type" id="">
                <option value="{{ \App\Constants\TaxonomySetting::BRAND }}" {{ (@$brandModel->type == \App\Constants\TaxonomySetting::BRAND) ? 'selected="true"' : null }}>
                   Brand
                </option>
                <option value="{{ \App\Constants\TaxonomySetting::MODEL }}" {{ (@$brandModel->type == \App\Constants\TaxonomySetting::MODEL) ? 'selected="true"' : null }}>
                   Model
                </option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="role">Ảnh đại diện</label>
            <div class="col d-flex justify-content-center" style="margin-top: 10px;">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="border-radius: 5px;width: 200px; height: 150px;">
                        <img class="viewImage" src="{{@$brandModel->avatar ? asset($brandModel->avatar): asset('backend/images/no-image.png')}}" alt="Ảnh đại diện" />
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"> 
                    </div>
                    <div class="d-flex justify-content-center" style="margin-top: 10px;">
                        <button type="button" class="btn btn-secondary btn-file">
                            <span class="fileupload-new"><i class="fa fa-picture-o"></i> Chọn ảnh đại diện</span>
                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Thay đổi</span>
                            <input type="file" id='avatar' name='avatar' class="btn-secondary"/>
                        </button>
                    </div>
                </div>
            </div>
            <span class="help-block">{{ $errors->first('avatar') }}</span>
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-outline-primary mr-1">
        <i class="ft-check"></i> Lưu Lại
    </button>
    <button type="button" class="btn btn-outline-warning" onclick="location.href='{{route('taxonomies.index')}}';">
        <i class="ft-x"></i> Trở lại
    </button>
</div>
@csrf