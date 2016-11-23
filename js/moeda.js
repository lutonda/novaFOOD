$(document).ready(function () {
    $('.moeda').each(function () {
        var num = $(this).html().split('.');
        var d = ($(this).html().split('.').length == 2) ? $(this).html().split('.')[0] : $(this).html();
        var a = d.split('').reverse();
        var nova = '';
        $j = 0;
        for ($i = 0; $i < d.split('').length; $i++) {
            nova += a[$i];
            if ($j++ == 2 && $i != d.split('').length - 1) {
                nova = nova + '.';
                $j = 0;
            }
        }
        a = '';
        d = nova.split('').reverse();
        for ($i = 0; $i < nova.split('').length; $i++) {
            a += d[$i]
        }
        var diz = ($(this).html().split('.').length == 2) ? '' + $(this).html().split('.')[1] : ""
        if (diz.split('').length == 0)diz = '00';
        if (diz.split('').length == 1)diz = diz + '0';
        if (diz.split('').length == 2)diz = diz;

        a += ',' + diz;
        $(this).html(a);
    })
})
