export default class DeviceService {

    constructor(httpService) {
        this.httpService = httpService;
        this.route = '/devices';
    }

    index() {
        const resourceRoute = '/admin-devices';
        return this.httpService.makeGet(resourceRoute)
            .then((res) => {
                return Promise.resolve(res);
            })
            .catch((err) => {
                return Promise.reject(err);
            });
    }

    store(device) {
        const data = this.makeResource(device);
        return this.httpService.makePost(this.route, data)
            .then((res) => {
                return Promise.resolve(res);
            })
            .catch((err) => {
                return Promise.reject(err);
            });
    }

    show(id) {
        const resourceRoute = `${this.route}/${id}`;
        return this.httpService.makeGet(resourceRoute)
            .then((res) => {
                return Promise.resolve(res);
            })
            .catch((err) => {
                return Promise.reject(err);
            });
    }

    update(device, id) {
        const resourceRoute = `${this.route}/${id}`;
        const data = this.makeResource(device);
        return this.httpService.makePut(resourceRoute, data)
            .then((res) => {
                return Promise.resolve(res);
            })
            .catch((err) => {
                return Promise.reject(err);
            });
    }

    makeResource(device) {
        return {
            device: device
        };
    }

}
