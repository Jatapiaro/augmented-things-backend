export default class Device {

    constructor() {
        this.id = "";
        this.name = "";
        this.latitude = "";
        this.longitude = "";
        this.altitude = "";

        this.place_id = "";
        this.user_id = "";
        this.type_id = "";
    }

    fillFromResponse(res) {
        this.id = res.id;
        this.name = res.name;
        this.latitude = res.latitude;
        this.longitude = res.longitude;
        this.altitude = res.altitude;

        this.place_id = res.place_id;
        this.user_id = res.user_id;
        this.type_id = res.type_id;
    }

}
