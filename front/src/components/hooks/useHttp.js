import React from "react";
import axios from "axios";
import { getCookie, setCookie, getCookies } from "cookies-next"; // Importação correta
import { useNavigate } from "react-router-dom"; // Importação correta
import { useSnackbar } from "notistack";
import { Routes } from "react-router-dom";

const useHttp = () => {
    const [loading, setLoading] = React.useState(false);
    const { enqueueSnackbar } = useSnackbar();
    const navigate = useNavigate(); // Navegação correta
    const allowedRoutes = ["/auth/login", "/auth/register"];
    const innerHttp = axios.create({
        baseURL: process.env.REACT_APP_API_URL,
        headers: {
            Authorization: `Bearer ${getCookie("access-token")}`,
        },
    });
    console.log("innerHttp " + innerHttp);


    const setToken = (response) => {
        console.log('response');
        console.log(response);
        if (response && response.data && response.access_token) {
            setCookie("access-token", response.access_token);
            setCookie("refresh-token", response.data.refresh_token);
        }
    };

    const checkErrors = async (e) => {
        console.log('e');
        console.log(e);
        if (e.response?.status === 401 && getCookie("access-token")) {
            await refreshToken();
        } else if (
            e.response?.status === 401 &&
            !!allowedRoutes.find((el) => el === window.location.pathname) // Ajuste para usar window.location.pathname
        ) {
            await navigate("/auth/login");
        }
    };

    const get = async (route, params) => {
        setLoading(true);
        try {
            const res = await innerHttp.get(
                `${route}`,
                params ? { params } : {}
            );

            return res.data;
        } catch (e) {
            await checkErrors(e);
            if (e.response?.data === undefined) {
                await navigate.replace("/auth/login");
            }
            throw e;
        } finally {
            setLoading(false);
        }
    };

    const post = async (
        route,
        data,
        options,
        shouldShowErrorMessage = false
    ) => {
        setLoading(true);
        try {
            const res = await innerHttp.post(`${route}`, data, options);
            setToken(res.data);

            console.log('res');
            console.log(res);
            return res.data;
        } catch (e) {
            console.log(e);
            await checkErrors(e);

            if (e.response.data.errors) {
                throw Object.entries(e.response.data.errors).map((item) => {
                    if (shouldShowErrorMessage) {
                        enqueueSnackbar(item[1][0], {
                            variant: "error",
                            anchorOrigin: {
                                horizontal: "right",
                                vertical: "top",
                            },
                        });
                    }

                    return item[1][0];
                });
            }

            if (e.response.data.hasAdditionalInfo) throw e.response.data;

            if (shouldShowErrorMessage) {
                enqueueSnackbar(e.response.data.message, {
                    variant: "error",
                    anchorOrigin: {
                        horizontal: "right",
                        vertical: "top",
                    },
                });
            }
            throw e.response.data.message;
        } finally {
            setLoading(false);
        }
    };

    const requestWithProgress = async (type, route, data, onProgress) => {
        try {
            const res = await innerHttp[type](`${route}`, data, {
                onUploadProgress: (event) => {
                    const progress = Math.round(
                        (event.loaded * 100) / event.total
                    );
                    onProgress(progress);
                },
            });
            setToken(res.data);

            return res.data;
        } catch (e) {
            await checkErrors(e);

            if (e.response.data.errors) {
                throw Object.entries(e.response.data.errors).map(
                    (item) => item[1][0]
                );
            }
            throw e.response.data.message;
        }
    };

    const Delete = async (route, data) => {
        try {
            const res = await innerHttp.delete(`${route}`, data);
            setToken(res.data);

            return res.data;
        } catch (e) {
            await checkErrors(e);

            if (e.response.data.errors) {
                throw Object.entries(e.response.data.errors).map(
                    (item) => item[1][0]
                );
            }
            throw e.response.data.message;
        }
    };

    const patch = async (route, data) => {
        try {
            const res = await innerHttp.patch(`${route}`, data);

            return res.data;
        } catch (e) {
            await checkErrors(e);
            if (e.response.data.errors) {
                throw e.response.data.errors;
            }
            throw e.response.data.message;
        }
    };

    const put = async (route, data) => {
        try {
            const res = await innerHttp.put(`${route}`, data);
            setToken(res.data);

            return res.data;
        } catch (e) {
            await checkErrors(e);

            if (e.response.data.errors) {
                throw Object.entries(e.response.data.errors).map(
                    (item) => item[1][0]
                );
            }
            throw e.response.data.message;
        }
    };

    const getToken = () => {
        const tempData = {};
        tempData.refresh_token = getCookie("refresh-token");
        return tempData;
    };

    const logout = async () => {
        Object.keys(getCookies()).forEach((name) => {
            setCookie(name, "", { maxAge: 1 });
        });
        navigate.reload(); // Navegação correta
    };

    const refreshToken = async () => {
        try {
            const refresh = getToken("refresh-token");
            const response = await post(Routes.auth.refresh_token, refresh);
            if (response.message === "Token renovado com sucesso!") {
                setCookie("access-token", response.data.token);
                setCookie("refresh-token", refresh.refresh_token);
                return null;
            }
            await logout();
        } catch (e) {
            await logout();
        }
        return null;
    };

    innerHttp.interceptors.response.use(undefined, async (err) => {
        const { config, message, response } = err;
        if (!config || config.retry < 0) {
            return Promise.reject(err);
        }
        if (response.status === 503) {
            axios(config);
        }
        if (
            response?.data?.message?.includes("Token expirado!") &&
            response.status === 401
        ) {
            await refreshToken();
            config.headers.Authorization = getCookie("access-token");
            return axios(config);
        }
        if (
            response?.data?.message?.includes(
                "Usuário bloqueado! Entre em contato com o administrador."
            ) ||
            response?.data?.message?.includes(
                "Quantidade máxima de tentativas excedida!"
            )
        ) {
            logout();
        }
        if (
            !(message.includes("timeout") || message.includes("Network Error"))
        ) {
            return Promise.reject(err);
        }
        config.retry -= 1;
        const delayRetryRequest = new Promise((resolve) => {
            setTimeout(() => {
                resolve();
            }, config.retryDelay || 1000);
        });
        return delayRetryRequest.then(() => axios(config));
    });

    return {
        get,
        post,
        requestWithProgress,
        put,
        patch,
        refreshToken,
        Delete,
        loading,
    };
};

export default useHttp;
