class ClassRequestHelper {

    constructor(apiUrl) {
        this.apiUrl = apiUrl;
    }

    async getJson(uri, body) {
        const queryString = body !== null ? "?" + this.queryStringFromObject(body) : "";
        const response = await fetch(this.apiUrl + uri + queryString, {
            method: "GET",
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
        });

        try {
            return await response.json();
        } catch (error) {
            return {
                status: 'error',
                message: 'A requisição não pode ser processada'
            };
        }
    }

    async postJson(uri, body) {
        const data = {
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            method: "POST",
            body: JSON.stringify(body),
        };

        try {
            const response = await fetch(this.apiUrl + uri, data);
            return await response.json();
        } catch (error) {
            return {
                status: 'error',
                message: 'A requisição não pode ser processada'
            };
        }
    }

    async putJson(uri, body) {
        const data = {
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            method: "PUT",
            body: JSON.stringify(body),
        };

        try {
            const response = await fetch(this.apiUrl + uri, data);
            return await response.json();
        } catch (error) {
            return {
                status: 'error',
                message: 'A requisição não pode ser processada'
            };
        }
    }

    async deleteJson(uri, body) {
        const data = {
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            method: "DELETE",
            body: JSON.stringify(body),
        };
        try {
            const response = await fetch(this.apiUrl + uri, data);
            return await response.json();
        } catch (error) {
            return {
                status: 'error',
                message: 'A requisição não pode ser processada'
            };
        }
    }

    queryStringFromObject(obj) {
        if (obj === undefined || obj === null) {
            return "";
        }

        return Object.keys(obj)
            .map((key) => {
                    return `${key}=${encodeURIComponent(obj[key])}`;
            })
            .join("&");
    }
}
    
export default ClassRequestHelper;

export const RequestHelper = new ClassRequestHelper(
    import.meta.env.VITE_API_URL
);