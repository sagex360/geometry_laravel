class FigureService {
    constructor() {
        this.http = axios.create({
            baseURL: '/api/figures/'
        });
    }

    list() {
        return this.http.get('/');
    }

    generate() {
        return this.http.post('/');
    }

    changeColor() {
        return this.http.put('/change-color');
    }
}

export default new FigureService();
