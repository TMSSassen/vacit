$(document).ready(function ()
{
    initSlides();
});
class Vacature_slides {
    constructor(vacatures) {
        this.vacatures = JSON.parse(vacatures);
        this.current = 0;
        this.max = this.vacatures.length;
    }

    start()
    {
        this.changeText(this.vacatures[this.current]);
        this.nextCycle(this.vacatures, this.current,
                this.max, this.changeText, this.nextCycle);
    }
    nextCycle(vacatures, current, max, changeText, nextCycle)
    {
        setTimeout(() => {
            $('#titel').fadeTo(1000, 0, () => {
                current = current < max - 2 ? current + 1 : 0;
                changeText(vacatures[current]);
                $('#titel').fadeTo(1000, 1, () => {
                    nextCycle(vacatures, current, max, changeText, nextCycle);
                });
            });
        }, 10000);
    }
    changeText(current)
    {
        $('#titel').text(current.niveau + ' ' + current.titel);
        $('#platform').attr('src',$('#img_path').attr('content')+current.platform+'.svg');
    }
}
function initSlides()
{
    let slides = new Vacature_slides($('#vacatures').attr('content'));
    slides.start();
}