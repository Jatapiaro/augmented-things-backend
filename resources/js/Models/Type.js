export default class Type {

    constructor() {
        this.id = '';
        this.type = '';
        this.used = false;
    }

    fillFromResponse(data) {
        this.id = data.id;
        this.type = data.type;
        this.used = data.used;
    }

}
