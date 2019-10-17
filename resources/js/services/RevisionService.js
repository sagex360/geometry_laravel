class RevisionService {
    constructor() {
        this.http = axios.create({
            baseURL: '/api/revisions'
        });
    }

    revert(id) {
        return this.http.post(`/revert/${id}`)
    }

    revertLast(quantity) {
        return this.http.post(`/revertLast/${quantity}`);
    }
}

export default new RevisionService();
