
<div class="col-lg-6">
    <button type="button" class="btn btn-black" data-bs-toggle="modal" data-bs-target="#exampleModal">
        إلغاء الطلب
    </button>
</div>

<div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <form method="post" action="{{route('refuse-order',$order->id)}}" >
                @csrf
                <div class="modal-body">
                    <h5 class="title">سبب الغاء الطلب</h5>
                    <h5 class="sub-title">من فضلك أدخل سبب الغاء الطلب </h5>
                    <textarea name="message" class="form-control" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gray" data-bs-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn ">إرسال</button>
                </div>
            </form>

        </div>
    </div>
</div>
