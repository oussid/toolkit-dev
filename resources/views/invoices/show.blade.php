@extends("layouts.main")
@section("content")
<div class="">
    
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    var element = document.getElementById('printBtn');
    element.addEventListener("click", ()=>{
        var conta = document.getElementById('print');
        html2pdf(conta);

    })
</script>

@endsection
