const Alert = {
    namespaced: true,
    state: {
        show: false,
        type: 'success',
        message: '',
        closeTimeout: 0,
        canClose: false
    },
    mutations: {
        change(state, payload) {
            // Default values
            const defaultState = Alert.getters.getDefaulStateValues();

            Object.keys(defaultState).forEach((key) => {
                if (payload.hasOwnProperty(key)) {
                    state[key] = payload[key];
                } else {
                    state[key] = defaultState[key];
                }
            });
        }
    },
    actions: {
        async show({ commit }, data) {
            commit('change', { ...data, show: true });
        },
        async hide({ commit }) {
            commit('change', { show: false });
        },
    },
    getters: {
        getDefaulStateValues() {
            return {
                show: false,
                type: 'success',
                message: '',
                closeTimeout: 0,
                canClose: false
            };
        }
    }
};

export default Alert;