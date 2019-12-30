export default class PlaceService {

    constructor(httpService) {
        this.httpService = httpService;
        this.route = '/places';
    }

    index() {
        const resourceRoute = `/admin-places`;
        return this.httpService.makeGet(resourceRoute)
            .then((res) => {
                return Promise.resolve(res);
            })
            .catch((err) => {
                return Promise.reject(err);
            });
    }

    store(place) {
        const data = this.makeResource(place);
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

    update(place, id) {
        const resourceRoute = `${this.route}/${id}`;
        const data = this.makeResource(place);
        return this.httpService.makePut(resourceRoute, data)
            .then((res) => {
                return Promise.resolve(res);
            })
            .catch((err) => {
                return Promise.reject(err);
            });
    }

    makeResource(place) {
        return {
            place: place
        };
    }

}
