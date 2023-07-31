<template>
    <div>
        <component :is="$route.meta.layout || `div`">
            <router-view />
        </component>
    </div>
</template>