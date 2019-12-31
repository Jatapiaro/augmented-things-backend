export default class UserService {

    constructor(httpService) {
        this.httpService = httpService;
        this.route = '/users';
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

}
