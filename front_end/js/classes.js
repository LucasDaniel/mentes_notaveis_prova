/*
Dimensão em centimetros
*/
const STATUS = {
    true:"ON",
    false:"OFF"
};

class Status {
    status;
    constructor () {
        return {};
    }
}

class Dimension {
    width = 0;
    height = 0;
    depth = 0;
    constructor (width, height, depth) {
        this.width = width;
        this.height = height;
        this.depth = depth;
    }
}

class Lighter extends Status {
    cor;
    constructor(cor) {
        super();
        this.status = false;
        this.cor = cor;
    }
}

class TheStove extends Status {
    constructor () {
        super();
        this.status = false;
    }
}

class LightBulb extends Status {
    constructor () {
        super();
        this.status = false;
    }
}

class Glass {
    dimension;
    constructor (width, height, depth) {
        this.dimension = new Dimension(width, height, depth);
    }
}

class Homeappliance {
    stove;
    lighter;
    constructor () {
        return {};
    }
}

class Oven extends Homeappliance {
    lightbulb;
    buttonLightBulb;
    glass;
    constructor (width, height, depth) {
        super();
        this.glass = new Glass(width, height, depth);
        this.stove = [
            new TheStove()
        ];
        this.lighter = [
            new Lighter('amarelo')
        ];
        this.lightbulb = [
            new LightBulb()
        ];
        this.buttonLightBulb = [
            new Status()
        ];
    }
}

class Stove extends Homeappliance {
    cor = 'preto';
    dimension;
    oven;
    brand;
    constructor (width, height, depth,brand) {
        super();
        this.brand = brand;
        this.dimension = new Dimension(width, height, depth);
        this.oven = new Oven(width/1.5,height/3,0.25);
        this.stove = [
            new TheStove(),
            new TheStove(),
            new TheStove(),
            new TheStove()
        ];
        this.lighter = [
            new Lighter('vermelho'),
            new Lighter('verde'),
            new Lighter('azul'),
            new Lighter('rosa')
        ];
    }
}