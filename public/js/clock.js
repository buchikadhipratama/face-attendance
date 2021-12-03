function getServerTime(){
    return $.ajax({async: false}).getAllResponseHeaders('Date');
}
function realtimeClock(){
    var rtClock = new Date();

    var hours = rtClock.getHours();
    var minutes = rtClock.getMinutes();
    var seconds = rtClock.getSeconds();

    // JIKA MAU MENANPILKAN JAM DALAM BENTUK AM:PM
    // var amPm = (hours < 12 ) ? "AM : PM";
    // hour = (hours > 12) ? hours - 12 : hours;

    hours = ("0" + hours).slice(-2);
    minutes = ("0" + minutes).slice(-2);
    seconds = ("0" + seconds).slice(-2);

    document.getElementById("clock").innerHTML = hours + ":" + minutes + ":" + seconds;
    // jika mau ditambahkan am/pm tinggal ditambahkan baris data dibawah ini, dengan melanjutkan baris code diatas
    // + " " + amPm;

    var clock = setTimeout(realtimeClock, 500);
}
