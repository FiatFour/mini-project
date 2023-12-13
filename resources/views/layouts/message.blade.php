@if (Session::has('deleted'))
    <script>
        Swal.fire({
            title: "ลบแล้ว!",
            text: "ข้อมูลที่คุณเลือกถูกลบเรียบร้อยแล้ว.",
            icon: "success"
        });
    </script>
@endif

@if (Session::has('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "สำเร็จ",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
