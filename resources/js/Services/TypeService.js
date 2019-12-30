export default class TypeService {

    constructor(httpService) {
        this.httpService = httpService;
        this.route = '/types';
    }

    index() {
        return this.httpService.makeGet(this.route)
            .then((res) => {
                return Promise.resolve(res);
            })
            .catch((err) => {
                return Promise.reject(err);
            });
    }

    store(type) {
        const data = this.makeResource(type);
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

    update(type, id) {
        const data = this.makeResource(type);
        const resourceRoute = `${this.route}/${id}`;
        return this.httpService.makeaPut(resourceRoute, data)
            .then((res) => {
                return Promise.resolve(res);
            })
            .catch((err) => {
                return Promise.reject(err);
            });
    }

    makeResource(type) {
        return {
            'type': type
        }
    }

}
