
let f = new Stove(100,80,90,'Eletrolux');

function useStove(i) {
    onOffStove(f,i);
    refreshStove();
}

function useOven() {
    onOffStove(f.oven,0);
    refreshStove();
}

function useLightBulbOven() {
    onOffLightBulb(f.oven);
    refreshStove();
}

function refreshStove() {
    for (i = 1; i < 5; i++) {
        let str = "stove"+i;
        changeLabelOnOff(f.stove[i-1],str);
    }
    changeLabelOnOff(f.oven.stove[0],"oven");
    changeLabelOnOff(f.oven.lightbulb[0],"lightOven");
}

function onOffStove(obj,i) {
    obj.lighter[i].status = !obj.lighter[i].status;
    obj.stove[i].status = obj.lighter[i].status;
}

function onOffLightBulb(obj) {
    obj.buttonLightBulb[0].status = !obj.buttonLightBulb[0].status;
    obj.lightbulb[0].status = obj.buttonLightBulb[0].status;
}

function changeLabelOnOff(obj,str) {
    document.getElementById(str).innerHTML = STATUS[obj.status];
    document.getElementById(str).classList.remove(STATUS[!obj.status]);
    document.getElementById(str).classList.add(STATUS[obj.status]);
}

refreshStove();
