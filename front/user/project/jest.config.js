module.exports = {
  preset: '@vue/cli-plugin-unit-jest/presets/typescript-and-babel',
  moduleNameMapper: {
    '^~/(.*)$': '<rootDir>/tests/unit/$1',
  },
};
