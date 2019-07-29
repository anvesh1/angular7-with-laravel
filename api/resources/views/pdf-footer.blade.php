{{--{{dd($compData[0]->name)}}--}}
<!DOCTYPE html>

<div class="col-lg-12" style="padding-left: 0px;padding-right: 0px;margin-top: 15px; margin-left: -10px;margin-right: -10px;
        background-color: rgb(34, 34, 34) !important;padding: 8px;
        border-color: rgb(34, 34, 34) !important;height: 70px;">
    <div class="row" style="">
        <div class="col-lg-6">
            <a>
                <img src="{{$compData[0]->logo_image}}" style="width: 50px;margin-top: 10px;">
            </a>
            <div style="margin-top: -46px;margin-left: 58px;">
                <strong style="color: #b6e781;">{{$compData[0]->name}}</strong>
            </div>
            <div style="margin-top: 0px;margin-left: 58px;">
                <strong style="color: #b6e781;">{{$compData[0]->website}}</strong>
            </div>
        </div>
        <div class="col-lg-6" style="float: right;">
            <div style="margin-top: -39px;margin-left: 58px;">
                <strong style="color: #b6e781;">Email: {{$compData[0]->email}}</strong>
            </div>
            <div style="margin-top: 0px;margin-left: 58px;">
                <strong style="color: #b6e781;">Contact: {{$compData[0]->contact_number}}</strong>
            </div>
        </div>
    </div>
</div>