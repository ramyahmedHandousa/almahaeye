
<div class="col-lg-6">
    <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$order->id}}">
        إنهاء الطلب
    </button>
</div>

<div class="modal fade" id="exampleModal-{{$order->id}}" data-bs-backdrop="static" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form method="post" action="{{route('finish-order',$order->id)}}" >
                @csrf
                <div class="modal-body">
                    <h5 class="title">هل انت متأكد من إنهاء الطلب</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gray" data-bs-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn ">نعم</button>
                </div>
            </form>

        </div>
    </div>
</div>
