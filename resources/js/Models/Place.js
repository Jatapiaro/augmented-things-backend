export default class Place {

    constructor() {
        this.id = '';
        this.name = '';
        this.latitude = '';
        this.longitude = '';
        this.altitude = '';
        this.user_id = '';
    }

    fillFromResponse(res) {
        this.id = res.id;
        this.name = res.name;
        this.latitude = res.latitude;
        this.longitude = res.longitude;
        this.altitude = res.altitude;
        this.user_id = res.user_id;
    }

}
