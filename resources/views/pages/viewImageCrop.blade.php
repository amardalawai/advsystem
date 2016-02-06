<style>
    .jcrop-keymgr{
        opacity: 0;
    }
    .close{
        display: none;
    }
</style>
<div class="text-center">
    <img src="{{ $image }}" id="cropBoxModal" />
</div>

<div class="text-center">
    <br>
    <br>
    <button class="btn btn-success" onclick="saveCrop()"><i class="fa fa-crop"></i> Crop Selection</button>
</div>

<input type="hidden" id="mx" name="mx" />
<input type="hidden" id="my" name="my" />
<input type="hidden" id="mw" name="mw" />
<input type="hidden" id="mh" name="mh" />

<input type="hidden" id="strSquare" name="strSquare" value="{{ $strSquare }}" />

<script type='text/javascript'>
    $(document).ready(function () {

        var strSquare = $('#strSquare').val();
        $(function () { 
            if (strSquare == 1) {
                $('#cropBoxModal').Jcrop({
                    setSelect: [0, 0, 500, 500],
                    onSelect: updateCoords,
                    aspectRatio: 1,
                    minSize: [50, 50],
                    boxWidth: 500,
                    boxHeight: 500
                });
            }
            else {
                $('#cropBoxModal').Jcrop({
                    onSelect: updateCoords,
                    setSelect: [250, 200, 50, 50],
                    aspectRatio: 16 / 9,
                    minSize: [300, 200],
                    boxWidth: 500,
                    boxHeight: 500
                });
            }
        });

        function updateCoords(c)
        {
            $('#mx').val(Math.round(c.x));
            $('#my').val(Math.round(c.y));
            $('#mw').val(Math.round(c.w));
            $('#mh').val(Math.round(c.h));

            $('#x').val(Math.round(c.x));
            $('#y').val(Math.round(c.y));
            $('#w').val(Math.round(c.w));
            $('#h').val(Math.round(c.h));
        }




    });

    function checkCoords()
    {
        if (parseInt($('#w').val()))
            return true;
        alert('Please select a crop region then press submit.');
        return false;
    }

    function saveCrop() {
        if (checkCoords()) {
            $('#commonBox').modal('hide');
        }
    }
</script>