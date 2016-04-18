$(document).ready(function() {
var progressbar = $('#progress_bar');
max = progressbar.attr('max');
time = (222 / max) * 5;
value = progressbar.val();

var loading = function() {
value += 1;
addValue = progressbar.val(value);

$('.progress-value').html(value + '%');
var $ppc = $('.progress-pie-chart'),
deg = 360 * value / 100;
if (value > 50) {
$ppc.addClass('gt-50');
}

$('.ppc-progress-fill').css('transform', 'rotate(' + deg + 'deg)');
$('.ppc-percents span').html(value + '%');

if (value == max) {
clearInterval(animate);
}
};

var animate = setInterval(function() {
loading();
}, time);
});